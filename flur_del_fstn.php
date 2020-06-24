<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$gemarkung=$_GET["gemarkung"];
$flur=$_GET["flur"];
$zaehler=$_GET["zaehler"];
$id=$_GET["id"];
echo"<font face=\"Arial\"><h3>Flurstückszähler löschen</h3></font>
<br><br>Folgender Zähler wird gelöscht:<br>
<table>
<tr>
<td width=\"200\">Gemarkung</td>
<td>$gemarkung</td>
</tr>
<tr>
<td>Flur</td>
<td>$flur</td>
</tr>
<tr>
<td>Zähler</td>
<td>$zaehler</td>
</tr>
</table>
<br><br>
<a href=\"flur_del2_fstn.php?gemarkung=$gemarkung&flur=$flur&zaehler=$zaehler&id=$id\">[Wirklich löschen]</a>&nbsp;&nbsp;<a href=\"flur_show_fstn.php?id=$id\">[Nicht löschen]</a><br><br>";

nav_flur("alkgrund");
bottom();
?>