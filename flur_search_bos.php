<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("bos");
?>
<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("bos");

?>
<br>
<form action="flur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4" >
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Bodensch&auml;tzung</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">
<input  type="Radio" name="fselekt" value="70" checked>Fluren mit einer Bodensch&auml;tzung<br>
<input  type="Radio" name="fselekt" value="71">Folie 42 in der ALK eingearbeitet<br>
<input  type="Radio" name="fselekt" value="72">Fluren mit einer Nachschätzung<br>
<input  type="Radio" name="fselekt" value="73">Ergebnisse der Bodensch&auml;tzung in das ALB &uuml;bernommen<br>
</td>
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
<tr><td><input type="Submit" name="" value="Suche starten"></td></tr>
</table>
</form>


<?php

nav_flur("alkgrund");
bottom();
?>