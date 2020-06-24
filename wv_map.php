<?php
include ("connect_pgsql.php");
include ("baust_function.php");


$rechts=$_GET["rechts"];
$hoch=$_GET["hoch"];
$range=$_GET["range"];
$name=$_GET["name"];
$kopf=$_GET["kopf"];


$lu_rechts=$rechts-($range/2);
$lu_hoch=$hoch-($range/2);
$ro_rechts=$rechts+($range/2);
$ro_hoch=$hoch+($range/2);

$wms_call=URL."cgi-bin/mapserv?map=/srv/www/wms/meta.map&request=getMap&VERSION=1.1.0&layers=Top.-Karten,Fluren,Werkverträge&width=600&height=600&BBOX=".$lu_rechts.",".$lu_hoch.",".$ro_rechts.",".$ro_hoch;

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
If ($kopf == '1') 
 {
  head_baust();
  nav_baust();
 }

$link=URL."kva/"."wv_map.php";

echo "<table>
<tr><td>
<table>
<tr>
<td align=\"center\"><a href=\"",$link,"?rechts=$n_o_r&hoch=$n_o_h&range=$range&name=$name&kopf=$kopf\"><img src=\"images/buttons/nach_oben.png\" alt=\"Karte nach oben verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_l_r&hoch=$n_l_h&range=$range&name=$name&kopf=$kopf\"><img src=\"images/buttons/nach_links.png\" alt=\"Karte nach links verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_r_r&hoch=$n_r_h&range=$range&name=$name&kopf=$kopf\"><img src=\"images/buttons/nach_rechts.png\" alt=\"Karte nach rechts verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$n_u_r&hoch=$n_u_h&range=$range&name=$name&kopf=$kopf\"><img src=\"images/buttons/nach_unten.png\" alt=\"Karte nach unten verschieben\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$rechts&hoch=$hoch&range=$smaller&name=$name&kopf=$kopf\"><img src=\"images/buttons/plus.png\" alt=\"hinein zoomen\" border=\"0\" width=\"25\"></a>
&nbsp;&nbsp;
<a href=\"",$link,"?rechts=$rechts&hoch=$hoch&range=$bigger&name=$name&kopf=$kopf\"><img src=\"images/buttons/minus.png\" alt=\"heraus zoomen\" border=\"0\" width=\"25\"></a>
</td>
</tr>
<tr>
<td><img src=$wms_call alt=\"\" width=\"600\" border=\"1\"></td>
</tr>
</table>
</td>
<td>&nbsp;&nbsp;</td>
<td><h3>$name</h3></td>
</tr></table>";

?>
