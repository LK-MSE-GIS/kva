<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();
nav_flur("alkis");
?>

<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("alkis");
?>
<br>

<form action="xflur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4">
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
ALKIS-Vormigration</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">Feldvergleich (Geb&auml;ude)<br><br>
<input  style="font-family:Arial; font-size: 10pt; font-weight: bold"type="Radio" name="fselekt" value="9">kein Gebäudebestand<br>
<input  type="Radio" name="fselekt" value="50" checked>bisher noch keine Aktion<br>
<input  type="Radio" name="fselekt" value="52">abgeschlossen, noch nicht in ALK<br>
<input  type="Radio" name="fselekt" value="51">abgeschlossen (in ALK)</td>
</tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">Vergleich ALB-ALK<br><br>

<input  type="Radio" name="fselekt" value="55">bisher noch keine Aktion<br>
<input  type="Radio" name="fselekt" value="56">abgeschlossen</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">Vormigration<br><br>
<input  type="Radio" name="fselekt" value="100">keine Aktion<br>
<input  type="Radio" name="fselekt" value="102">Aktualisierung Stufe 1 abgeschlossen, bereit füt Stufe 2<br>
<input  type="Radio" name="fselekt" value="103">ALKIS Vormigration Stufe 2 abgeschlossen<br>
<input  type="Radio" name="fselekt" value="107">2b steht noch aus<br>
<input  type="Radio" name="fselekt" value="108">2b steht noch aus, Testmigration abgeschlossen<br>
<input  type="Radio" name="fselekt" value="106">ALKIS Vormigration Stufe 2b (Knickpunkte) abgeschlossen<br>
<input  type="Radio" name="fselekt" value="104">ALKIS Testmigration abgeschlossen</td></tr>

<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Gemarkung:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"gemark_id\">";

 $query5="SELECT * FROM gemarkung ORDER by gemarkung";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["gemark_id"] == '0')
   {
   echo " selected";
   }
   echo " value=\"$r5[gemark_id]\">$r5[gemarkung]</option>\n";
   }
   echo "
      </select>";
?>
</tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Mitarbeiter:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"mitarb_id\">";

 $query6="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%' OR abteilung LIKE '%feld%'";
 $result6=mysqli_query($db_link,$query6);

 while($r6=mysqli_fetch_array($result6))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r6["mitarb_id"] == '0')
   {
   echo " selected";
   }
   echo " value=\"$r6[mitarb_id]\">$r6[name]</option>\n";
   }
   echo "
      </select>";
?>
</tr>
<tr><td><input type="Submit" name="" value="Suche starten"></td></tr>
</table>
</form>



<?php

nav_flur("alkis");
bottom();
?>