<?php
include ("connect.php");
include ("li_function.php");

head_li_balk();

echo "<h3>Suchen</h3>";

echo "<form action=\"li_balk_find.php?\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"start\" value=\"1\">
<table>
<tr>
<td width=\"250\">Auftragsnummer:</td>
<td><input type=\"int\" name=\"nummer\" value=\"\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Gemarkung:</td>
<td>
<select name=\"gemark_id\">";

 $query="SELECT * FROM gemarkung where gemark_id < '139999' ORDER BY gemarkung";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }

 echo "</select>
</td>

<tr>
<td>
Flur:
</td>
<td>
<input type=\"Text\" name=\"flur_id\" value=\"\" size=\"3\" maxlength=\"3\">
</td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"mitarb_id\">";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>Jahrgang:</td>
<td><input type=\"text\" name=\"year\" value=\"$year\" size=\"4\" maxlength=\"4\"></td>
</tr>
<tr>
<td colspan=\"2\"><br><input type=\"Submit\" name=\"\" value=\"Suchen starten\"></td>
</tr>
</table>
</form>";

bottom();
?>