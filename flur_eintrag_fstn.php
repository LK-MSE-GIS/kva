<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$gemarkung=$_GET["gemarkung"];
$flur=$_GET["flur"];
$id=$_GET["id"];
echo"<form action=\"flur_ins_eintrag_fstn.php\" method=\"POST\">
<input type=\"hidden\" name=\"gemarkung\" value=\"$gemarkung\">
<input type=\"hidden\" name=\"flur\" value=\"$flur\">
<input type=\"hidden\" name=\"id\" value=\"$id\">
<font face=\"Arial\"><h3>Neuen Zähler erfassen</h3></font>
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
<td><input type=\"Text\" name=\"zaehler\" value=\"\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Nenner</td>
<td><input type=\"Text\" name=\"nenner\" value=\"0\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Bemerkung</td>
<td><input type=\"Text\" name=\"comment\" value=\"\" size=\"50\" maxlength=\"50\"></td>
</tr>
</table>
<br>
<br>
<input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;<input type=\"reset\" value=\"Zurücksetzen\">&nbsp;&nbsp;<a href=\"flur_show_fstn.php?id=$id\">[Abbrechen]</a>
</form>";

nav_flur("alkgrund");
bottom();
?>