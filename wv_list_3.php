<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("baust_function.php");

head_baust();
nav_baust();

wv_navi();
?>
<body>

<font face="Arial">


<div align="center">



<?php

  $query="SELECT oid as id,box(the_geom) as box,bezeichnung,vermessungsstelle,abgabe,status from fd_wv where status='3' ORDER BY bezeichnung;";
  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $wv[$count]=$r;
    }

   echo "$count Fluren<br><br>";
   
?>
<h2>Werkverträge (abgeschlossen)</h2>
<table>
<tr>
<td width="150">Bezeichnung</td>
<td width="150">ÖbVI</td>
<td width="150">Datum</td>
<td width="200">Status</td>
</tr>


<tr><td colspan="6"><hr></td></tr>


<?php
  
for ($i=1;$i<=$count;$i++)
    {
  $id=$wv[$i][id];
  $boxstring=$wv[$i][box];
  $klammern=array("(",")");
  $boxstring=str_replace($klammern,"",$boxstring);
  $koordinaten=explode(",",$boxstring);
  $rechts_range=$koordinaten[0]-$koordinaten[2];
  $rechts=$koordinaten[2]+($rechts_range/2);
  $hoch_range=$koordinaten[1]-$koordinaten[3];
  $hoch=$koordinaten[3]+($hoch_range/2);
  $range=$hoch_range;
  if ($rechts_range > $hoch_range) $range=$rechts_range;
  $range=$range+4000;
  $name=$wv[$i][bezeichnung];
     $link=URL."kva/"."wv_map.php?rechts=$rechts&hoch=$hoch&range=$range&name=$name&kopf=0";

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$wv[$i][bezeichnung],"</td>
     <td>",$wv[$i][vermessungsstelle],"</td>
     <td>",$wv[$i][abgabe],"</td>
     <td>";
     if ($wv[$i][status] == '1') echo "bereit zur Übernahme";
     if ($wv[$i][status] == '2') echo "ALB-Übernahme";
     if ($wv[$i][status] == '0') echo "bei Verm.-Stelle";
     if ($wv[$i][status] == '3') echo "abgeschlossen";
     
     echo "</td>";
     if ((strpos($abteilung,"wv") > -1) OR (strpos($abteilung,"adm") > -1)) echo "<td><a href=\"wv_edit.php?id=$id\">Status ändern</a>
     </td><td>|</td>";
     echo "<td><a href=\"$link \" target=\"about_blank\">Zur Karte</a>
     </td>";
   echo"</tr>";
    }

?>

</table>
</body>    