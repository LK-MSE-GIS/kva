<?php
include ("connect_pgsql.php");
include ("baust_function.php");


$rechts=$_GET["rechts"];
$hoch=$_GET["hoch"];
$range=$_GET["range"];
$oid=$_GET["oid"];
$gemeindename=$_GET["gemeindename"];


 $query="SELECT oid,gemeinde,stichtag,zonennr,zonentyp,verfahrensgrund,verfahrensgrund_zusatz,beitragszustand,nutzungsart,standort,richtwertdefinition,bodenrichtwert,bodenrichtwertnummer,stichtag,box(transform(the_geom,2398)) as box FROM bw_zonen WHERE oid='$oid'";

 $result = $dbqueryp($connectp,$query);

  $r = $fetcharrayp($result);
  $boxstring=$r[box];
  $klammern=array("(",")");
  $boxstring=str_replace($klammern,"",$boxstring);
  $koordinaten=explode(",",$boxstring);
  $rechts_range=$koordinaten[0]-$koordinaten[2];
  $rechts_reset=$koordinaten[2]+($rechts_range/2);
  $hoch_range=$koordinaten[1]-$koordinaten[3];
  $hoch_reset=$koordinaten[3]+($hoch_range/2);
  $range_reset=$hoch_range;
  if ($rechts_range > $hoch_range) $range_reset=$rechts_range;
  $range_reset=$range_reset+4;
  $gemeinde_id=$r[gemeinde];
  $stichtag=$r[stichtag];


$lu_rechts=$rechts-($range/2);
$lu_hoch=$hoch-($range/2);
$ro_rechts=$rechts+($range/2);
$ro_hoch=$hoch+($range/2);

$wms_call=URL."cgi-bin/mapserv?map=/srv/www/wms/meta.map&request=getMap&VERSION=1.1.0&layers=Flurkarte-BRW,BORIS-F,BORIS-L&width=600&height=600&FORMAT=image/png&SRS=EPSG:2398&BBOX=".$lu_rechts.",".$lu_hoch.",".$ro_rechts.",".$ro_hoch;


$n_o_r=$rechts;
$n_o_h=$hoch+($range/2);
$n_u_r=$rechts;
$n_u_h=$hoch-($range/2);

$n_l_r=$rechts-($range/2);
$n_l_h=$hoch;
$n_r_r=$rechts+($range/2);
$n_r_h=$hoch;

$smaller=$range/2;
$bigger=$range*2;


$link=URL."kva/"."brw_map.php";

echo "<table>
<tr><td>
<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr><td width=200>
<form action=\"brw_gemeinde.php\" method=\"post\" target=\"\">
<input type=hidden name=\"gemeinde_id\" value=\"$gemeinde_id\">
<input type=hidden name=\"stichtag\" value=\"$stichtag\">
<input type=\"Submit\" name=\"\" value=\"Zurück\">
</form>
</td>
<td width=400></td></tr>
<tr><td width=200>Gemeinde:</td>
<td width=400>$gemeindename</td></tr>
<tr><td width=200>Stichtag:</td>
<td width=400>$r[stichtag]</td></tr>
<tr><td width=200>Zone:</td>
<td width=400>$r[zonennr]";
if ($r[verfahrensgrund] == 'SAN') echo "<br>Sanierungsgebiet";
echo "</td></tr>
<tr><td width=200>Bodenrichtwertnummer:</td>
<td width=400>$r[bodenrichtwertnummer]</td></tr>
<tr><td width=200>Standort:</td>
<td width=400>$r[standort]</td></tr>
<tr><td width=200>Richtwertdefinition:</td>
<td width=400>$r[richtwertdefinition]</td></tr>
<tr><td width=200>Bodenrichtwert:</td>
<td width=400>$r[bodenrichtwert] €/m²</td></tr>
<tr><td width=200>Zonentyp:</td>
<td width=400>$r[zonentyp]</td></tr>
<tr><td width=200>Beitragszustand:</td>
<td width=400>$r[beitragszustand]</td></tr>
<tr><td width=200>Nutzungsart:</td>
<td width=400>$r[nutzungsart]</td></tr>
</table>
</tr>
<tr><td><hr></td></tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td align=\"center\"><a href=\"",$link,"?rechts=$n_o_r&hoch=$n_o_h&range=$range&oid=$oid\"><img src=\"images/buttons/nach_oben.png\" alt=\"Karte nach oben verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_l_r&hoch=$n_l_h&range=$range&oid=$oid\"><img src=\"images/buttons/nach_links.png\" alt=\"Karte nach links verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_r_r&hoch=$n_r_h&range=$range&oid=$oid\"><img src=\"images/buttons/nach_rechts.png\" alt=\"Karte nach rechts verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_u_r&hoch=$n_u_h&range=$range&oid=$oid\"><img src=\"images/buttons/nach_unten.png\" alt=\"Karte nach unten verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$rechts&hoch=$hoch&range=$smaller&oid=$oid\"><img src=\"images/buttons/plus.png\" alt=\"hinein zoomen\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$rechts&hoch=$hoch&range=$bigger&oid=$oid\"><img src=\"images/buttons/minus.png\" alt=\"heraus zoomen\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$rechts_reset&hoch=$hoch_reset&range=$range_reset&oi&oid=$oid&gemeindename=$gemeindename\">Zone $r[zonennr]</a>
</td>
</tr>
<tr>
<td><img src=$wms_call alt=\"\" width=\"600\" border=\"1\"></td>
</tr>
</table>";

echo "<form action=\"brw_gemeinde.php\" method=\"post\" target=\"\">
<input type=hidden name=\"gemeinde_id\" value=\"$gemeinde_id\">
<input type=hidden name=\"stichtag\" value=\"$stichtag\">
<input type=\"Submit\" name=\"\" value=\"Zurück\">
</form>";

?>
