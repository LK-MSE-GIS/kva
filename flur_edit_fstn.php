<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$gemarkung=$_GET["gemarkung"];
$flur=$_GET["flur"];
$zaehler=$_GET["zaehler"];
$id=$_GET["id"];

$query="SELECT * FROM fstn WHERE gemarkung=$gemarkung AND flur=$flur AND zaehler=$zaehler";
$result=mysql_query($query);
$r=mysql_fetch_array($result);


echo "<form action=\"flur_ins_fstn.php\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"gemarkung\" value=\"$gemarkung\">
<input type=\"hidden\" name=\"flur\" value=\"$flur\">
<input type=\"hidden\" name=\"zaehler\" value=\"$zaehler\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<font face=\"Arial\"><h3>Flurstückszähler bearbeiten</h3></font>
<table>
<tr>
<td width=\"200\">Gemarkung</td>
<td width=\"200\">$r[gemarkung]</td>
</tr>
<tr>
<td width=\"200\">Flur</td>
<td width=\"200\">$r[flur]</td>
</tr>
<tr>
<td width=\"200\">Zaehler</td>
<td width=\"200\">$r[zaehler]</td>
</tr>
<tr>
<td>Nenner</td>
<td><input type=\"Text\" name=\"nenner\" value=\"$r[nenner]\" size=\"5\"></td>
</tr>
<tr>
<td>Bemerkung</td>
<td><input type=\"Text\" name=\"comment\" value=\"$r[comment]\" size=\"50\"></td>
</tr>
</table>
<br>
<input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;<input type=\"reset\" value=\"Zurücksetzen\">&nbsp;&nbsp;<a href=\"flur_show_fstn.php?id=$id\">[Abbruch]</a>&nbsp;&nbsp;<a href=\"flur_del_fstn.php?gemarkung=$gemarkung&flur=$flur&zaehler=$zaehler&id=$id\">[Diesen Zähler löschen]</a>
</form>";

nav_flur("alkgrund");
bottom();
?>