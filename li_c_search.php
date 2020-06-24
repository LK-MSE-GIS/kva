<?php
include ("connect.php");
include ("li_function.php");

head_li_c();

echo "<h3>Suchen</h3>";

echo "<form action=\"li_c_find.php\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"start\" value=\"1\">
<table>
<tr>
<td width=\"250\">ALB-Nummer:</td>
<td><input type=\"int\" name=\"number\" value=\"\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Bemerkung:</td>
<td><input type=\"int\" name=\"bem\" value=\"\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td valign=\"top\">
Grundbuch
</td>
<td>
<input type=\"Text\" name=\"grubu\" value=\"\" size=\"35\" maxlength=\"35\"><br>
<small>Zur nicht exakten Suche geben Sie bitte ein %-Zeichen als Platzhalter ein.<br><br>
<b>Beispiel: 1640% </b><br>zeigt alle Grundbucheintragungen f&uuml;r den Grundbuchbezirk 1640</small>
</td>
</tr>
<tr>
<td>Jahrgang:</td>
<td><input type=\"date\" name=\"year\" value=\"$year\" size=\"4\" maxlength=\"4\"></td>
</tr>
<tr>
<td colspan=\"2\"><br><input type=\"Submit\" name=\"\" value=\"Suchen starten\"></td>
</tr>
</table>
</form>";

bottom();
?>