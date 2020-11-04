<SCRIPT language="javascript">
function sicher()
  {
   return window.confirm("Hiermit bestätigen Sie, das der Abgleich von ALK und ALB erfolgreich war. Ihre Mitarbeiter-ID wird zugeordnet.");
  }

</SCRIPT>


<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

function doccheck($gemark_id,$nummer,$dbqueryp,$connectp,$fetcharrayp)
  {
   
   $gemarkung=$gemark_id;
   $query="SELECT * from n_nachweise WHERE substring(CAST(flurid AS CHAR VARYING) from 1 for 6)='$gemark_id' AND stammnr='$nummer' ORDER BY art,stammnr,blattnummer";
   
   $result = $dbqueryp($connectp,$query);
   $zaehler=0;
   
   while($n = $fetcharrayp($result))
    {
     $zaehler++;
     if ($zaehler == '1') echo "------<small>$gemarkung</small>-------<br>";
     $stammnr=$n[stammnr];
     while (strlen($stammnr) < 8)
     {
      $stammnr="0".$stammnr;
     }
     $dname="/docs/".$n['flurid']."/".$stammnr."/".$n['link_datei']; 
     if ($n["art"]=='100') echo "<small><a href=\"$dname\" target=\"about_blank\">Fortführungsriss, Blatt:",$n["blattnummer"]," (",$n["format"],")</small></a><br>";
     if ($n["art"]=='010') echo "<small><a href=\"$dname\" target=\"about_blank\">Koordinatenverzeichnis, Blatt:",$n["blattnummer"]," (",$n["format"],")</small></a><br>";
     if ($n["art"]=='001') echo "<small><a href=\"$dname\" target=\"about_blank\">Grenzniederschrift, Blatt:",$n["blattnummer"]," (",$n["format"],")</small></a><br>";
     if ($n["art"]=='111') echo "<small><a href=\"$dname\" target=\"about_blank\">sonst. Dokument, Blatt:",$n["blattnummer"]," (",$n["format"],")</small></a><br>";
    }
    return $zaehler;
 
 
}


xhead_ant();
xmain_nav();
xnav_ant();

if ((strpos($abteilung,"ueb") > -1) OR (strpos($abteilung,"adm") > -1)) $ueb =1;


$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];


$query="SELECT o.*, x.* FROM antrag as o, antrag_extra as x  WHERE o.id=$id  AND o.id=x.id";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
if($r["id"]>0)
{
$gemarkung_1=$r["gemark_id_1"];
$flur_1=$r["flur_1"];
while (strlen($flur_1) <3)
  {
    $flur_1='0'.$flur_1;
  }
$flur_id_1=$gemarkung_1."-".$flur_1;
$flurid_1=$gemarkung_1.$flur_1; 
   

if ($r["gemark_id_2"] > 0)
 {
 $gemarkung_2 =$r["gemark_id_2"];
 if ($r["flur_2"] > 0)
  {
   $flur_2 =$r["flur_2"];
   while (strlen($flur_2) <3)
  {
    $flur_2='0'.$flur_2;
  }
  $flur_id_2=$gemarkung_2."-".$flur_2;
  $flurid_2=$gemarkung_2.$flur_2;
  }
}

if ($r["gemark_id_3"] > 0)
 {
 $gemarkung_3 =$r["gemark_id_3"];
 if ($r["flur_3"] > 0)
  {
   $flur_3 =$r["flur_3"];
   while (strlen($flur_3) <3)
  {
    $flur_3='0'.$flur_3;
  }
  $flur_id_3=$gemarkung_3."-".$flur_3;
  $flurid_3=$gemarkung_3.$flur_3;
  }
 }


$aktenz=$r["number"]."/".substr($r["year"],2,2);
echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
echo"<form action=\"ant_aendern_einfuegen_ueb.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"status\" value=\"$status\">";
echo "<input type=hidden name=\"page\" value=\"$page\">";

nav_aendern($id,$db_link,$page,$status);

echo "<table border=\"1\">
<tr bgcolor=\"#EFA036\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> &Uuml;bernahme&nbsp;&nbsp;$aktenz&nbsp;</td></tr>
<tr bgcolor=\"#EFA036\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr>";
$query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysqli_query($db_link,$query10);
     $r10=mysqli_fetch_array($result10);
     echo"<td>$r10[vermst],&nbsp;</td>";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysqli_query($db_link,$query12);
     $r12=mysqli_fetch_array($result12);
     echo"<td>$r12[vermart],&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
     echo"<td>$r11[gemarkung]&nbsp;($r[gemark_id_1])";
 if ($r["flur_1"]!="") echo ",&nbsp;Flur: $r[flur_1]";
 if ($r["flst_1alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_1alt"],0,10),"</td></tr>";

if ($r["gemark_id_2"] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_2]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_2])";
 if ($r["flur_2"]!="") echo ",&nbsp;Flur: $r[flur_2]";
 if ($r["flst_2alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_2alt"],0,10),"</td></tr>";
 }

if ($r['gemark_id_3'] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_3]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_3])";
 if ($r["flur_3"]!="") echo ",&nbsp;Flur: $r[flur_3]";
 if ($r["flst_3alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_3alt"],0,10),"</td></tr>";
 }

 echo "</table></td>
</tr>";

echo "<tr bgcolor=\"#EFA036\">
 <td>&Uuml;-Datum </td>
 <td>Mitarbeiter</td>
 <td>&Uuml;bernahme Ok?</td>
 <td>Aktenort</td>
</tr>
<tr>

 <td><input type=\"date\" name=\"ueb_datum\" value=\"$r[ueb_datum]\" size=\"10\" maxlength=\"10\" onChange='document.forms[0].submit()'><a href=\"set_date.php?id=$r[id]&script=ant_aendern_uebernahme.php&table=antrag&column=ueb_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"\" border=\"0\"></a> </td>
 <td><select name=\"ueb_mit_id\" onChange='document.forms[0].submit()'>";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ueb%'";
 $result2=mysqli_query($db_link,$query2);

 while($r2=mysqli_fetch_array($result2))
   {
   echo "<option";
   if($r2["mitarb_id"] == $r["ueb_mit_id"])
   {
   echo " selected";
   }
   echo " value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "
      </select>
   </td>
      <td><select name=\"ueb_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r["ueb_ja_nein"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r["ueb_ja_nein"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   </select></td>
   <td><select name=\"aktort_id\" onChange='document.forms[0].submit()'>";

 $query3="SELECT * FROM aktort ORDER BY aktort_id";
 $result3=mysqli_query($db_link,$query3);

 while($r3=mysqli_fetch_array($result3))
   {
   echo "<option";
   if($r3["aktort_id"] == $r["aktort_id"])
   {
   echo " selected";
   }
   echo " value=\"$r3[aktort_id]\">$r3[aktort]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr>
 <td bgcolor=\"#EFA036\" colspan=\"3\">&Auml;nderungsnachweis</td>
 <td align=\"left\" style=\"font-family:Arial; font-size: 12pt; font-weight: bold\" rowspan=\"7\">";


 
 if ($r["gemark_id_1"] > 0)
 {
  
  if (((strpos($abteilung,"alk") > -1) OR (strpos($abteilung,"adm") > -1)) AND ($flur_id_1 != '') AND ($r["alk_ja_nein"] == '0') AND ($r["aktort_id"] == '4')) echo get_gemark_name($r["gemark_id_1"],$db_link),":&nbsp;<a href=\"ant_baust_ins.php?flur_id=$flur_id_1&aktenz=$aktenz&mitarb=$username&page=$page&id=$idd&status=$status\"><img src=\"images/traffic.jpg\" alt=\"\" border=\"0\" width=\"25\"></a>";
 echo "<br>";
 }

if ($r["gemark_id_2"] > 0 AND $r["gemark_id_2"] != $r["gemark_id_1"])
 {
 
  if (((strpos($abteilung,"alk") > -1) OR (strpos($abteilung,"adm") > -1)) AND ($flur_id_2 != '') AND ($r["alk_ja_nein"] == '0') AND ($r["aktort_id"] == '4')) echo get_gemark_name($r["gemark_id_2"],$db_link),":&nbsp;<a href=\"ant_baust_ins.php?flur_id=$flur_id_1&aktenz=$aktenz&mitarb=$username&page=$page&id=$idd&status=$status\"><img src=\"images/traffic.jpg\" alt=\"\" border=\"0\" width=\"25\"></a>";
 echo "<br>";
 }



if ($r["gemark_id_3"] > 0 AND $r["gemark_id_3"] != $r["gemark_id_1"] AND $r["gemark_id_3"] != $r["gemark_id_2"])
 {
 
  if (((strpos($abteilung,"alk") > -1) OR (strpos($abteilung,"adm") > -1)) AND ($flur_id_3 != '') AND ($r["alk_ja_nein"] == '0') AND ($r["aktort_id"] == '4')) echo get_gemark_name($r["gemark_id_1"],$db_link),":&nbsp;<a href=\"ant_baust_ins.php?flur_id=$flur_id_1&aktenz=$aktenz&mitarb=$username&page=$page&id=$idd&status=$status\"><img src=\"images/traffic.jpg\" alt=\"\" border=\"0\" width=\"25\"></a>";
 }


echo "</td>
<td>";

echo "</td></tr>
<tr>
 <td colspan=\"3\"><input type=\"Text\" name=\"ueb_aen\" value=\"$r[ueb_aen]\" size=\"50\" maxlength=\"50\" onChange='document.forms[0].submit()'> </td>
 </tr>
 <tr bgcolor=\"#EFA036\">
 <td colspan=\"3\">ALK </td>
 </tr>
 <tr bgcolor=\"#EFA036\">
 <td >ALK-Datum </td>
 <td>Mitarbeiter</td>
 <td>ALK OK?</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"alk_datum\" value=\"$r[alk_datum]\" size=\"10\" maxlength=\"10\" onChange='document.forms[0].submit()'><a href=\"set_date.php?id=$r[id]&script=ant_aendern_uebernahme.php&table=antrag&column=alk_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"\" border=\"0\"></a> </td>
 <td>
 <select name=\"alk_mit_id\" onChange='document.forms[0].submit()'>";

 $query4="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alk%'";
 $result4=mysqli_query($db_link,$query4);

 while($r4=mysqli_fetch_array($result4))
   {
   echo "<option";
   if($r4["mitarb_id"] == $r["alk_mit_id"])
   {
   echo " selected";
   }
   echo " value=\"$r4[mitarb_id]\">$r4[name]</option>\n";
   }
   echo "
      </select>
 </td>

    <td><select name=\"alk_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r["alk_ja_nein"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r["alk_ja_nein"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   <option";
   if($r["alk_ja_nein"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">keine ALK</option>

   </select></td>
</tr>
 <tr bgcolor=\"#EFA036\">
 <td colspan=\"3\">ALB </td>
 </tr>
 <tr bgcolor=\"#EFA036\">
 <td >ALB-Datum </td>
 <td>Mitarbeiter</td>
 <td>ALB OK?</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"alb_datum\" value=\"$r[alb_datum]\" size=\"10\" maxlength=\"10\" onChange='document.forms[0].submit()'><a href=\"set_date.php?id=$r[id]&script=ant_aendern_uebernahme.php&table=antrag&column=alb_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"\" border=\"0\"></a> </td>
 <td>
 <select name=\"alb_mit_id\" onChange='document.forms[0].submit()'>";

 $query6="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result6=mysqli_query($db_link,$query6);

 while($r6=mysqli_fetch_array($result6))
   {
   echo "<option";
   if($r6["mitarb_id"] == $r["alb_mit_id"])
   {
   echo " selected";
   }
   echo " value=\"$r6[mitarb_id]\">$r6[name]</option>\n";
   }
   echo "
      </select>
 </td>

    <td><select name=\"alb_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r["alb_ja_nein"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r["alb_ja_nein"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   <option";
   if($r["alb_ja_nein"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">kein ALB</option>
   </select></td>
</tr>";

  echo " <tr><td colspan=\"5\" bgcolor=\"#EFA036\" align=right style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
  if ($r["me_datum"] <= '2009-05-20') echo "Kein ALK/ALB-Abgleich vorgesehen";
  else
   {
    if ($r["abgl_date"] == '0000-00-00') 
       if ($ueb ==1)  echo "<a href=\"set_date.php?id=$r[id]&script=ant_aendern_uebernahme.php&table=antrag&column=abgl_date&page=$page&status=$status\" onClick=\"return sicher()\">ALK/ALB-Abgleich bestätigen</a>";
       else echo"Ableich noch nicht durchgeführt";
    else 
      {
        $query6="SELECT * FROM mitarbeiter WHERE mitarb_id = '$r[abgl_mitid]'";
        $result6=mysqli_query($db_link,$query6);
        $r6=mysqli_fetch_array($result6);
        echo "ALK/ALB-Abgleich erfolgreich durchgeführt von $r6[name] am $r[abgl_date]";
      }
   }
  echo "</td></tr>";





  echo "<tr>
 <td colspan=\"5\" bgcolor=\"#EFA036\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";

echo "</tr>
</table>";
}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
}
echo "</form></div></div>";


xnav_ant();
bottom();
?>