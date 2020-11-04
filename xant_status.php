<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
xnav_ant();
?>



<?php

$antgesamt=0;
$antvorb=0;
$anteing=0;
$antalk=0;
$antalb=0;
$antriss=0;
$antrech=0;
$antarchiv=0;
$antstorno=0;
$antaway=0;

$query="SELECT * from antrag;";
$result=mysqli_query($db_link,$query);
while($r=mysqli_fetch_array($result))
  {
   $antgesamt++;
   if ($r["aktort_id"]=='1') $antvorb++;
   if ($r["aktort_id"]=='2') $antbuero++;
   if ($r["aktort_id"]=='3') $anteing++;
   if ($r["aktort_id"]=='4' AND $r["vermart_id"] !='5') $antalk++;
   if ($r["aktort_id"]=='4' AND $r["vermart_id"] =='5') $antalkwv++;
   if ($r["aktort_id"]=='5') $antalb++;
   if ($r["aktort_id"]=='11') $antriss++;
   if ($r["aktort_id"]=='6') $antrech++;
   if ($r["aktort_id"]=='7') $antarchiv++;
   if ($r["aktort_id"]=='8') $antstorno++;
   if ($r["aktort_id"]=='9') $antback++;
   if ($r["aktort_id"]=='99') $antaway++;
  }

echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<font face=\"Arial\"><h1>Übersicht Antragsdatenbank</h1>";
echo "<table>
<tr><td colspan=\"2\"><h1><hr></h1></td></tr>
<tr>
<td width=\"300\"><a href=\"xant_searchlist.php?fehler=$0&page=0&status=1\">Vorbereitung:</a></td>
<td align=\"right\">$antvorb</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=2\">beim Vermessungsb&uuml;ro</a></td>
<td align=\"right\">$antbuero</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=3\">Eingangspr&uuml;fung</a></td>
<td align=\"right\">$anteing</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=4\">&Uuml;bernahme in die ALK (ohne Werkverträge)</a></td>
<td align=\"right\">$antalk</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=14\">&Uuml;bernahme in die ALK (Werkverträge)</a></td>
<td align=\"right\">$antalkwv</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=5\">&Uuml;bernahme/ALB</a></td>
<td align=\"right\">$antalb</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=11\">Risse scannen</a></td>
<td align=\"right\">$antriss</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=6\">Rechnung schreiben</a></td>
<td align=\"right\">$antrech</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=7\">im Archiv</a></td>
<td align=\"right\">$antarchiv</td>
</tr>
<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=8\">storniert</a></td>
<td align=\"right\">$antstorno</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=9\">zur&uuml;ck an Vermessungsstelle</a></td>
<td align=\"right\">$antback</td>
</tr>
<tr>
<td><a href=\"xant_searchlist.php?fehler=$0&page=0&status=99\">???</a></td>
<td align=\"right\">$antaway</td>
</tr>
</table><br><br></font>
</div>";


xnav_ant();
bottom();
?>