<?php
include ("connect_pgsql.php");
$gemeinde_id=$_POST["gemeinde_id"];
$stichtag=$_POST["stichtag"];
$sort=$_GET["sort"];


?>

<font face="Arial"><h1>Bodenrichtwertzonen</h1>
<a href="brw_start.php">Zurück</a> 

<br><br>
 <?php

 $query="SELECT gemeindename FROM alb_v_gemeinden WHERE gemeinde='$gemeinde_id' ";

 $result = $dbqueryp($connectp,$query);
 $r = $fetcharrayp($result);
 $gemeindename=$r[gemeindename];

echo "Gemeinde: $r[gemeindename]($gemeinde_id)<br>Stichtag:$stichtag<br><br>";

echo "<table>";
 $query="SELECT oid,zonennr,standort,richtwertdefinition,bodenrichtwertnummer,bodenrichtwert,box(transform(the_geom,2398)) as box FROM bw_zonen WHERE stichtag='$stichtag' AND gemeinde='$gemeinde_id' ORDER BY zonennr";

 $result = $dbqueryp($connectp,$query);

     echo "<table><tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td>Zone</td>
           <td>BRW-Nummer</td>
           <td width=300>Standort</td>
           <td>Richtwertdefinition</td>
           <td align=right>Bodenwert</td>
           </tr>
           <tr><td colspan=4><hr></td></tr>";



 $i=0;
 while($r = $fetcharrayp($result))
   {
  $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }

  $boxstring=$r[box];
  $klammern=array("(",")");
  $boxstring=str_replace($klammern,"",$boxstring);
  $koordinaten=explode(",",$boxstring);
  $rechts_range=$koordinaten[0]-$koordinaten[2];
  $rechts=$koordinaten[2]+($rechts_range/2);
  $hoch_range=$koordinaten[1]-$koordinaten[3];
  $hoch=$koordinaten[3]+($hoch_range/2);
  $range=$hoch_range;
  if ($rechts_range > $hoch_range) $range=$rechts_range;
  $range=$range+4;
  $oid=$r[oid];
  
     $link=URL."kva/"."brw_map.php?rechts=$rechts&hoch=$hoch&range=$range&oid=$oid&gemeindename=$gemeindename";

     echo "<tr bgcolor=$Farbe style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td><a href=\"$link \">$r[zonennr]</a></td>
           <td>$r[bodenrichtwertnummer]</td>
           <td>$r[standort]</td>
           <td>$r[richtwertdefinition]</td>
           <td align=right>$r[bodenrichtwert]</td>
           </tr>";
   }
echo "</table>";
?>




<br>
<br>


