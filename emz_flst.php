<?php
include ("connect_pgsql.php");
$flur_id=$_POST["flur_id"];
$gemkgname=$_POST["gemkgname"];

?>

<font face="Arial"><h1>Ermittlung der Bodenwertzahlen</h1>
<a href="emz_start.php">Zurück</a><br><br>
 <?php

echo "Flurstücke in der Flur: $flur_id<br><br>";

echo "<table>";
 $query="SELECT * FROM flurstuecke WHERE parentidentifier = '$flur_id' ORDER BY geographicidentifier";

 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   $zaehler=$r[zaehler];
   $i=0;
   While ($zaehler[$i] == '0')
      {
        $zaehler[$i]=" ";
        $i++;
      }
    
   $nenner=$r[nenner];   
   $i=0;
   While ($nenner[$i] == '0')
      {
        $nenner[$i]=" ";
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
/*  $cquery="select DISTINCT intersection(o.the_geom,f.the_geom) AS intersection_geom,o.* FROM alkobj_e_fla as o, flurstuecke as f,alkobj_t_pkt as t WHERE o.the_geom && f.the_geom AND intersects(o.the_geom,f.the_geom) AND o.objnr=t.objnr AND f.geographicidentifier='$flst' AND o.objart BETWEEN 222 AND 223 AND area(intersection(o.the_geom,f.the_geom))>0";

  $cresult = $dbqueryp($connectp,$cquery);
  $count=0;

  while($cr = $fetcharrayp($cresult))
    {
     $count++;
     }
 if ($count > 0) */
echo "<td>
 <small><a href=\"emz_calc.php?flst=$r[geographicidentifier]&name=$gemkgname&flur=$r[flur]&nummer=$nummer\" target=_blank><small>Bodenwertzahlen berechnen (falls möglich)</small></a></small></td>";
   echo "</tr>";
   }
?>




<br>
<br>


