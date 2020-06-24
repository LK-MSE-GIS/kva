<?php
include ("connect.php");
include ("li_function.php");

head_li_a();

echo "<h3>Suchen</h3>";

echo "<form action=\"li_a_find.php\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"start\" value=\"1\">
<table>
<tr>
<td width=\"250\">ALB-Nummer:</td>
<td><input type=\"int\" name=\"number\" value=\"\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Antragsnummer:</td>
<td><input type=\"int\" name=\"antrag\" value=\"\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Verm.art:</td>
<td>
<select name=\"vermart_id\">";

 $query="SELECT * FROM vermart ORDER BY vermart";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
   }

 echo "</select>
</td>

<tr>
<td valign=\"top\">
Flurst&uuml;ck(e)
</td>
<td>
<input type=\"Text\" name=\"flst\" value=\"\" size=\"18\" maxlength=\"18\">
<br>
<small>Zur nicht exakten Suche geben Sie bitte ein %-Zeichen als Platzhalter ein.<br><br>
<b>Beispiel: 1640% </b><br>zeigt alle Flurst&uuml;ckseintragungen f&uuml;r die Gemarkung 1640</small>
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