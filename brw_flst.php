<?php
include ("connect_pgsql.php");
$flur_id=$_POST["flur_id"];
$gemkgname=$_POST["gemkgname"];
$stichtag=$_POST["stichtag"];

?>

<font face="Arial"><h1>Ermittlung des Bodenrichtwertes</h1>
<a href="brw_start.php">Zurück</a><br><br>
 <?php

echo "Flurstücke in der Flur: $flur_id<br><br>Stichtag:$stichtag";

echo "<table>";
 $query="SELECT * FROM flurstuecke WHERE parentidentifier = '$flur_id' ORDER BY geographicidentifier";

 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   $zaehler=$r[zaehler];
   $i=0;
   While ($zaehler[$i] == '0')
      {
        $zaehler[$i]="";
        $i++;
      }
    
   $nenner=$r[nenner];   
   $i=0;
   While ($nenner[$i] == '0')
      {
        $nenner[$i]="";
        $i++;
      }
   
   echo "<tr><td width=100>$zaehler";
   $nummer=$zaehler;
   if ($r[nenner] > 0)
     {
      echo "/$nenner";
      $nummer=$nummer."/".$nenner;
     }
   echo "<td>";
   $flst=$r[geographicidentifier];
  $cquery="select intersection(o.the_geom,f.the_geom) AS intersection_geom,round(area(intersection(o.the_geom,f.the_geom))) as flaeche,round(area(f.the_geom)) as flst_flaeche,o.oid as id,o.* FROM bw_bodenrichtwertzonen as o, flurstuecke as f WHERE o.the_geom && f.the_geom AND intersects(o.the_geom,f.the_geom) AND f.geographicidentifier='$flst' AND o.datum LIKE '$stichtag' AND area(intersection(o.the_geom,f.the_geom))>0";

  $cresult = $dbqueryp($connectp,$cquery);
  $count=0;

  while($cr = $fetcharrayp($cresult))
    {
     $count++;
     $wert=$cr[bodenwert];
     }
 if ($count > 0) echo "
 <td width=300>Bodenrichtwert in EUR: $wert<td> 
<td>
 <small><a href=\"brw_calc.php?flst=$r[geographicidentifier]&name=$gemkgname&flur=$r[flur]&nummer=$nummer&stichtag=$stichtag\" target=_blank>Details</a></small></td>";
   echo "</tr>";
   }
?>




<br>
<br>


