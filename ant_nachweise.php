<SCRIPT language="javascript">
function sicher()
  {
   return window.confirm("Soll die Rissnummer wirklich entfernt werden?");
  }

</SCRIPT>




<?php
include ("connect.php");
include ("connect_geobasis.php");
include ("function.php");


$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];
$alt=$_GET["alt"];
$plus=$_GET["plus"];


function doccheck($gemark_id,$nummer,$dbqueryp,$connectp,$fetcharrayp,$ant_id,$page,$alt,$status)
  {
   
   $gemarkung=$gemark_id;
   $query="SELECT a.id,a.flurid,a.rissnummer,a.blattnummer,a.format,a.link_datei,a.gueltigkeit,b.art from nachweisverwaltung.n_nachweise as a,nachweisverwaltung.n_dokumentarten as b WHERE a.art=b.id AND substring(CAST(a.flurid AS CHAR VARYING) from 1 for 6)='$gemark_id' AND a.rissnummer='$nummer' ORDER BY art,rissnummer,CAST(blattnummer AS INTEGER)";
   
   $result = $dbqueryp($connectp,$query);
   
   
   echo "<table border=0>";
  
   while($n = $fetcharrayp($result))
    {
     
     echo "<tr>";

     $rissnummer=$n[rissnummer];
     while (strlen($rissnummer) < 8)
     {
      $rissnummer="0".$rissnummer;
     }
     $dname="/docs/".$n['flurid']."/".$rissnummer."/".$n['link_datei']; 
     echo "<td width=100>";
     
     echo "</td>";     

     echo "<td width=220><small>";

     

     echo $n[art];
     
     echo "</td><td><small>Blatt:",$n[blattnummer],"</td>
     <td><small> (",$n[format],")</td>
     <td><a href=\"nachweise_anzeigen.php?nachweis_id=$n[id]&antrag_id=$ant_id&wohin=antrag&page=$page&alt=$alt&status=$status\"><img src=\"images/buttons/dok.png\" width=20 border=0 alt=\"Nachweis anzeigen\"></a>";
	 if ($n[gueltigkeit]=='0') echo " **";
	 echo "<td></tr>";
    }
    echo "</table>";
    return $zaehler;
 
 
}


head_ant();
nav_ant();




$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);

$gemarkung_1=$r[gemark_id_1];
$flur_1=$r[flur_1];
while (strlen($flur_1) <3)
  {
    $flur_1='0'.$flur_1;
  }
$flur_id_1=$gemarkung_1."-".$flur_1;
$flurid_1=$gemarkung_1.$flur_1; 
   

if ($r[gemark_id_2] > 0)
 {
 $gemarkung_2 =$r[gemark_id_2];
 if ($r[flur_2] > 0)
  {
   $flur_2 =$r[flur_2];
   while (strlen($flur_2) <3)
  {
    $flur_2='0'.$flur_2;
  }
  $flur_id_2=$gemarkung_2."-".$flur_2;
  $flurid_2=$gemarkung_2.$flur_2;
  }
}

if ($r[gemark_id_3] > 0)
 {
 $gemarkung_3 =$r[gemark_id_3];
 if ($r[flur_3] > 0)
  {
   $flur_3 =$r[flur_3];
   while (strlen($flur_3) <3)
  {
    $flur_3='0'.$flur_3;
  }
  $flur_id_3=$gemarkung_3."-".$flur_3;
  $flurid_3=$gemarkung_3.$flur_3;
  }
 }


$aktenz=$r[number]."/".substr($r[year],2,2);


if ($alt == 'no') nav_aendern($id,$dbname,$page,$status);
  else nav_aendern_alt($id,$dbname,$page,$status);

echo "<table border=\"0\">
<tr bgcolor=\"#EFA036\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> Nachweise&nbsp;&nbsp;$aktenz&nbsp;</td></tr>
<tr bgcolor=\"#EFA036\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr>";
$query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysql_query($query10,$db_link);
     $r10=mysql_fetch_array($result10);
     echo"<td>$r10[vermst],&nbsp;</td>";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysql_query($query12,$db_link);
     $r12=mysql_fetch_array($result12);
     echo"<td>$r12[vermart],&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
     echo"<td>$r11[gemarkung]&nbsp;($r[gemark_id_1])";
 if ($r[flur_1]!="") echo ",&nbsp;Flur: $r[flur_1]";
 if ($r[flst_1alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_1alt],0,10),"</td></tr>";

if ($r[gemark_id_2] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_2]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_2])";
 if ($r[flur_2]!="") echo ",&nbsp;Flur: $r[flur_2]";
 if ($r[flst_2alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_2alt],0,10),"</td></tr>";
 }

if ($r[gemark_id_3] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_3]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_3])";
 if ($r[flur_3]!="") echo ",&nbsp;Flur: $r[flur_3]";
 if ($r[flst_3alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_3alt],0,10),"</td></tr>";
 }

 echo "</table></td>
</tr><tr><td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">";




$r_count=0;


  if ($r[gemark_id_1] > 0)
   {
    echo $r[gemark_id_1]," (",get_gemark_name($r[gemark_id_1],$dbname),") ";
    if ($plus == $r[gemark_id_1])
      {
        $vorschlag=get_last_riss($r[gemark_id_1],$dbname)+1;
        echo"<form action=\"ant_riss.php\" method=\"post\" target=\"\">
        <input type=hidden name=\"id\" value=\"$id\">
        <input type=hidden name=\"status\" value=\"$status\">
        <input type=hidden name=\"page\" value=\"$page\">
        <input type=hidden name=\"alt\" value=\"$alt\">
        <input type=hidden name=\"gemark_id\" value=\"$r[gemark_id_1]\">";

        echo "<small>nächste freie Nummer: <input type=int size=5 name=\"vorschlag\" value=\"$vorschlag\"> 
         <input type=submit value=\"Rissnummer eintragen\"></form>";

        
      }
      else
      {
       if (strpos($abteilung,"ris") > 0) echo " <a href= \"ant_nachweise.php?id=$id&status=$status&page=$page&alt=$alt&plus=$r[gemark_id_1]\"><img src=\"images/buttons/plus2.png\" border=\"0\" alt =\"Rissnummer hinzufügen\" width=15></a><br>";
      }
    $riss_query="SELECT riss_id FROM risse2antrag WHERE antrag_id ='$id' AND gemark_id = '$r[gemark_id_1]'";
    $riss_result=mysql_query($riss_query,$db_link);    
    while($r_riss=mysql_fetch_array($riss_result))
    {
      echo "<table><tr><td valign=top>",$r_riss[0];
    if (strpos($abteilung,"ris") > 0) echo " <a href= \"ant_riss_del.php?id=$id&status=$status&page=$page&alt=$alt&gemark_id=$r[gemark_id_1]&riss_id=$r_riss[0]\"><img src=\"images/buttons/b_drop.png\" border=\"0\" alt =\"Rissnummer entfernen\" onClick=\"return sicher()\"></a>";
      echo "</td><td>";
      $flag=doccheck($r[gemark_id_1],$r_riss[0],$dbqueryp,$connectp,$fetcharrayp,$id,$page,$alt,$status);
      $r_count++;
      echo "</td></tr></table>";
    }
   }

  if ($r[gemark_id_2] > 0 AND  $r[gemark_id_2] != $r[gemark_id_1])
   {
    echo $r[gemark_id_2]," (",get_gemark_name($r[gemark_id_2],$dbname),") ";
    if ($plus == $r[gemark_id_2])
      {
        $vorschlag=get_last_riss($r[gemark_id_2],$dbname)+1;
        echo"<form action=\"ant_riss.php\" method=\"post\" target=\"\">
        <input type=hidden name=\"id\" value=\"$id\">
        <input type=hidden name=\"status\" value=\"$status\">
        <input type=hidden name=\"page\" value=\"$page\">
        <input type=hidden name=\"alt\" value=\"$alt\">
        <input type=hidden name=\"gemark_id\" value=\"$r[gemark_id_2]\">";

        echo "<input type=int size=5 name=\"vorschlag\" value=\"$vorschlag\"> 
         <input type=submit value=\"Rissnummer eintragen\"></form>";

        
      }
      else
      {
       if (strpos($abteilung,"ris") > 0) echo " <a href= \"ant_nachweise.php?id=$id&status=$status&page=$page&alt=$alt&plus=$r[gemark_id_2]\"><img src=\"images/buttons/plus2.png\" border=\"0\" alt =\"Rissnummer hinzufügen\" width=15></a><br>";
      }
    $riss_query="SELECT riss_id FROM risse2antrag WHERE antrag_id ='$id' AND gemark_id = '$r[gemark_id_2]'";
    $riss_result=mysql_query($riss_query,$db_link);    
    while($r_riss=mysql_fetch_array($riss_result))
    {
      echo "<table><tr><td valign=top>",$r_riss[0];
    if (strpos($abteilung,"ris") > 0) echo "<a href= \"ant_riss_del.php?id=$id&status=$status&page=$page&alt=$alt&gemark_id=$r[gemark_id_2]&riss_id=$r_riss[0]\"> <img src=\"images/buttons/b_drop.png\" border=\"0\" alt =\"Rissnummer entfernen\" onClick=\"return sicher()\"></a>";
      echo "</td><td>";
      $flag=doccheck($r[gemark_id_2],$r_riss[0],$dbqueryp,$connectp,$fetcharrayp,$id,$page,$alt,$status);
      $r_count++;
      echo "</td></tr></table>";
    }
   }


  if ($r[gemark_id_3] > 0 AND  $r[gemark_id_3] != $r[gemark_id_1] AND  $r[gemark_id_3] != $r[gemark_id_2])
   {
    echo $r[gemark_id_3]," (",get_gemark_name($r[gemark_id_3],$dbname),") ";
    if ($plus == $r[gemark_id_3])
      {
        $vorschlag=get_last_riss($r[gemark_id_3],$dbname)+1;
        echo"<form action=\"ant_riss.php\" method=\"post\" target=\"\">
        <input type=hidden name=\"id\" value=\"$id\">
        <input type=hidden name=\"status\" value=\"$status\">
        <input type=hidden name=\"page\" value=\"$page\">
        <input type=hidden name=\"alt\" value=\"$alt\">
        <input type=hidden name=\"gemark_id\" value=\"$r[gemark_id_3]\">";

        echo "<input type=int size=5 name=\"vorschlag\" value=\"$vorschlag\"> 
         <input type=submit value=\"Rissnummer eintragen\"></form>";

        
      }
      else
      {
       if (strpos($abteilung,"ris") > 0) echo " <a href= \"ant_nachweise.php?id=$id&status=$status&page=$page&alt=$alt&plus=$r[gemark_id_3]\"><img src=\"images/buttons/plus2.png\" border=\"0\" alt =\"Rissnummer hinzufügen\" width=15></a><br>";
      }
    $riss_query="SELECT riss_id FROM risse2antrag WHERE antrag_id ='$id' AND gemark_id = '$r[gemark_id_3]'";
    $riss_result=mysql_query($riss_query,$db_link);    
    while($r_riss=mysql_fetch_array($riss_result))
    {
      echo "<table><tr><td valign=top>",$r_riss[0];
    if (strpos($abteilung,"ris") > 0) echo "<a href= \"ant_riss_del.php?id=$id&status=$status&page=$page&alt=$alt&gemark_id=$r[gemark_id_3]&riss_id=$r_riss[0]\"> <img src=\"images/buttons/b_drop.png\" border=\"0\" alt =\"Rissnummer entfernen\" onClick=\"return sicher()\"></a>";
      echo "</td><td>";
      $flag=doccheck($r[gemark_id_3],$r_riss[0],$dbqueryp,$connectp,$fetcharrayp,$id,$page,$alt,$status);
      $r_count++;
      echo "</td></tr></table>";
    }
   }





 echo "</td></tr></table><br>";
 echo "<font face=\"arial\"><small><br>**) Dokument ist ungültig wegen eines übernommenen Flurneuordnungsverfahrens.<br><br>";
 

nav_ant();
bottom();
?>