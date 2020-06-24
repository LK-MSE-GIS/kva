<?php
include ("connect_pgsql.php");
include ("connect_kvw.php");
$oid=$_GET["oid"];

?>
<body link=#000000 alink=#000000 vlink=#000000>
<font face="Arial">
<div align="center">
<div align="left">

<div align="center">

<?php


  $query="SELECT oid,* from alb_g_namen_temp WHERE oid =$oid ";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $adressen[$count]=$r;
    }
   
echo "<h3>Soll dieser Datensatz gelöscht werden?</h3>";
?>

<table>
<tr>
<td width="250"><b>Alt</b></td>
<td width="250"><b>Neu</b></td>
<td width="200"><b>eingereicht von:</b></td>
<td width="150"><b>betroffene<br>Grundbücher</b></td>
</tr>

<?php
  
for ($i=1;$i<=$count;$i++)
    {
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
     echo "<tr bgcolor=$Farbe style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$adressen[$i][name1],"<br>
     ",$adressen[$i][name2],"<br>
     ",$adressen[$i][name3],"<br>
     ",$adressen[$i][name4],"</td>
     <td><br><br>",$adressen[$i][neu_name3],"<br>
     ",$adressen[$i][neu_name4],"</td>
     <td>";
   $user_ID=$adressen[$i][user_id];
   $wquery="SELECT u.Name,u.Vorname,u.stelle_id,s.ID,s.Bezeichnung FROM user as u, stelle as s WHERE u.ID = $user_ID AND u.stelle_id = s.ID";
   $wresult=mysql_db_query($dbname,$wquery);
   $wr=mysql_fetch_array($wresult);
   echo "$wr[Vorname] $wr[Name]<br>$wr[Bezeichnung]<br>",
         $adressen[$i][datum],"</td><td>";

  $name1=$adressen[$i][name1];
  $name2=$adressen[$i][name2];
  $oid=$adressen[$i][oid];

  $gbquery="SELECT n.lfd_nr_name,n.name1,n.name2,e.bezirk,e.blatt from alb_g_namen as n, alb_g_eigentuemer as e WHERE n.name1 LIKE '$name1' AND n.name2 LIKE '$name2' AND n.lfd_nr_name = e.lfd_nr_name";
  $gbresult = $dbqueryp($connectp,$gbquery);
  

  while($gbr = $fetcharrayp($gbresult))
    {
     echo "$gbr[bezirk]-$gbr[blatt]<br>";
     
    }
  echo "</tr>";

    }

?>

</table>
<br>
<br>
<table>
<tr>
<td width="50"><?php echo "<a href=\"adr_del2.php?id=$oid\">ja</a>";?></td>
<td width="50"><a href="adr_liste.php">nein</a></td>
</tr>
</table>
</body>    