<?php
include ("connect_pgsql.php");



$rechts=$_GET["rechts"];
$hoch=$_GET["hoch"];
$range=$_GET["range"];
$name=$_GET["name"];
$layer=$_GET["layer"];



$lu_rechts=$rechts-($range/2);
$lu_hoch=$hoch-($range/2);
$ro_rechts=$rechts+($range/2);
$ro_hoch=$hoch+($range/2);

$wms_call=URL."cgi-bin/mapserv?map=/srv/www/wms/meta.map&request=getMap&VERSION=1.1.0&layers=Flur-Geom,".$layer."&FORMAT=image/png&SRS=EPSG:2398&width=800&height=800&BBOX=".$lu_rechts.",".$lu_hoch.",".$ro_rechts.",".$ro_hoch;

$n_o_r=$rechts;
$n_o_h=$hoch+($range/2);
$n_u_r=$rechts;
$n_u_h=$hoch-($range/2);

$n_l_r=$rechts-($range/2);
$n_l_h=$hoch;
$n_r_r=$rechts+($range/2);
$n_r_h=$hoch;






echo "<div align=center><font face=arial><h2>Landkreis Müritz<br>Statistik der Flurdatenbank</h2><h3>$name</h3>
<img src=$wms_call alt=\"\" width=\"800\" border=\"1\"></td>";

?>
