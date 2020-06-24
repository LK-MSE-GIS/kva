<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("strha");
?>

<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("strha");
?>
<br>

<form action="flur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4">
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Überarbeitung von Strassen/Hausnummern</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold"><input  style="font-family:Arial; font-size: 10pt; font-weight: bold"type="Radio" name="fselekt" value="9">kein Gebäudebestand<br>
<input  type="Radio" name="fselekt" value="0">bisher noch keine Aktion<br>
<input  type="Radio" name="fselekt" value="1">Karten sind beim Amt<br>
<input  type="Radio" name="fselekt" value="2">vom Amt zurück<br>
<input  type="Radio" name="fselekt" value="3">vom Amt zurück, noch nicht in der ALK<br>
<input  type="Radio" name="fselekt" value="5">vom Amt zurück, noch nicht im ALB<br>
<input  type="Radio" name="fselekt" value="6">vom Amt zurück, noch nicht im ALB und nicht in der ALK<br>
<input  type="Radio" name="fselekt" value="7">im ALB eingearbeitet<br>
<input  type="Radio" name="fselekt" value="8">in der ALK eingearbeitet<br>
<input  style="font-family:Arial; font-size: 10pt; font-weight: bold"type="Radio" name="fselekt" value="4" checked>in ALK und ALB eingearbeitet</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Gemarkung:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"gemark_id\">";

 $query5="SELECT * FROM gemarkung ORDER by gemarkung";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[gemkg_id] == '0')
   {
   echo " selected";
   }
   echo " value=\"$r5[gemark_id]\">$r5[gemarkung]</option>\n";
   }
   echo "
      </select>";
?>
</tr>
<tr><td><input type="Submit" name="" value="Suche starten"></td></tr>
</table>
</form>


<?php

nav_flur("strha");
bottom();
?>