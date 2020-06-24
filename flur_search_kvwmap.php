<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("kvwmap");
?>

<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("kvwmap");
?>
<br>

<form action="flur_selekt.php" method="post" target="">
<table border="1"  bgcolor="#F3CAB4">
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur selektieren</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Rissarchivierung in kvwmap</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">
<input  type="Radio" name="fselekt" value="500">noch nichts erfasst<br>
<input  type="Radio" name="fselekt" value="501" checked>gescannte Risse erfasst (ohne KVZ)<br>
<input  type="Radio" name="fselekt" value="503" checked>gescannte Risse erfasst (mit KVZ)<br>
<input type="Radio" name="fselekt" value="502">alle (auch alte) Risse erfasst (ohne KVZ)<br>
<input type="Radio" name="fselekt" value="504">alle (auch alte) Risse erfasst (mit KVZ)<br>
<input type="Radio" name="fselekt" value="505">alle (auch alte) Risse erfasst (mit KVZ und Anlagen)<br>
<input type="Radio" name="fselekt" value="506">Georeferenzierung der alten Risse abgeschlossen<br>
<input type="Radio" name="fselekt" value="507">Dokumente vollständig erfasst<br>
<input type="Radio" name="fselekt" value="508">Nachbearbeitung abgeschlossen<br>
<input type="Radio" name="fselekt" value="509">Erfassung Nachweise abgeschlossen<br>
</tr>
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
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>eingrenzen auf Mitarbeiter:<br>
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"mitarb_id\">";

 $query6="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result6=mysql_query($query6);

 while($r6=mysql_fetch_array($result6))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r6[mitarb_id] == '0')
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

nav_flur("kvwmap");
bottom();
?>