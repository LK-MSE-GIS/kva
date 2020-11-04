<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();;
nav_flur("geb");
?>

<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("geb");
?>
<br>
<table>
<tr>
<td>
<form action="xflur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4">
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Altgeb&auml;udeerfassung</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold"><input  style="font-family:Arial; font-size: 10pt; font-weight: bold"type="Radio" name="fselekt" value="9">kein Gebäudebestand</td></tr>
<tr><td style="font-family:Arial; font-size: 10pt; font-weight: bold">
Status<br><br>
<input  type="Radio" name="fselekt" value="33" checked>keine Aktion<br>
<input  type="Radio" name="fselekt" value="34">Restmessung KVA<br>
<input  type="Radio" name="fselekt" value="35">Erfassung abgeschlossen</td></tr>
<tr><td style="font-family:Arial; font-size: 10pt; font-weight: bold">
Art der Erfassung<br><br>
<input  type="Radio" name="fselekt" value="31">Altgeb. wurden digitalisiert<br>
<input  type="Radio" name="fselekt" value="32">Altgeb. wurden gemessen<br>
<input  type="Radio" name="fselekt" value="39">Altgeb. wurden aus dem Luftbild entnommen</td></tr>
<tr><td style="font-family:Arial; font-size: 10pt; font-weight: bold">
Einarbeitung in die ALK-DB<br><br>
<input  type="Radio" name="fselekt" value="36">eingearbeitet<br>
<input  type="Radio" name="fselekt" value="37">Erfassung abgeschlossen, noch nicht eingearbeitet<br>

<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Gemarkung:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"gemark_id\">";

 $query5="SELECT * FROM gemarkung ORDER by gemarkung";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["gemkg_id"] == '0')
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
</td>
<td>&nbsp;&nbsp;</td>
<td valign="top">
<form action="xflur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4">
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Geb&auml;ude ab 1992</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold"><input  style="font-family:Arial; font-size: 10pt; font-weight: bold"type="Radio" name="fselekt" value="9">kein Gebäudebestand<br>
<input  type="Radio" name="fselekt" value="40">MS-Bau-Tabelle erzeugt<br>
<input  type="Radio" name="fselekt" value="41">MS-Bau Tabelle noch nicht erzeugt<br>
<input  type="Radio" name="fselekt" value="42">Aufforderungen verschickt<br>
<input  type="Radio" name="fselekt" value="43" checked>abgeschlossen<br>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Gemarkung:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"gemark_id\">";

 $query5="SELECT * FROM gemarkung ORDER by gemarkung";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["gemkg_id"] == '0')
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
</td>
</tr>
</table>

<?php

nav_flur("geb");
bottom();
?>