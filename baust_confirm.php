<head>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php

include("connect.php");
include("connect_pgsql.php");
include("baust_function.php");

$id=$_GET["id"];
$what=$_GET["what"];

  $query="SELECT gid,box(the_geom) as box,was,wo,wer,wann from fd_baustellen WHERE gid=$id";
  $result = $dbqueryp($connectp,$query);
  $r = $fetcharrayp($result);


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
  $range=$range+4000;

$lu_rechts=$rechts-($range/2);
$lu_hoch=$hoch-($range/2);
$ro_rechts=$rechts+($range/2);
$ro_hoch=$hoch+($range/2);




$wms_call=URL."cgi-bin/mapserv?map=/srv/www/wms/meta.map&request=getMap&VERSION=1.1.0&layers=Top.-Karten,Fluren,Baustellen&width=400&height=400&FORMAT=image/png&SRS=EPSG:2398&BBOX=".$lu_rechts.",".$lu_hoch.",".$ro_rechts.",".$ro_hoch;

head_baust();
nav_baust();

?>

<div align="center" style="font-family:Arial; font-size: 14pt; font-weight: bold">
<h2>M&ouml;chten Sie diese Baustelle wirklich löschen ?</h2>
<?php
echo "$r[wo]<br>$r[was]<br>$r[wer]<br>$r[wann]<br><br><img src=$wms_call alt=\"\" width=\"400\" border=\"1\"><br><br>";
echo "<a href=\"baust_del.php?id=$id&what=$what\">Ja</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"baust_list.php?what=$what\">Nein</a>";
?>
</div>
</body>