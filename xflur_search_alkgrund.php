<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();
nav_flur("alkgrund");
?>

<font face="Arial"><h2>Suchen</h2></font>
<?php
navi_flur_search("alkgrund");
?>
<br>
<table>
<tr>
<td>
<form action="xflur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4" >
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Bodenordnungsverfahren</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">
<input  type="Radio" name="fselekt" value="20" checked>BOV-Fluren gesamt<br>
<input  type="Radio" name="fselekt" value="21">Fluren in laufenden BOV<br>
<input type="Radio" name="fselekt" value="22">Fluren aus abgeschlossenen BOV<br>
</td>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold">
<td>Suche eingrenzen auf BOV:
<?php
echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bov\">";

 $query5="SELECT * FROM bov ORDER by NAME";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["bov_id"] == '0')
   {
   echo " selected";
   }
   echo " value=\"$r5[bov_id]\">$r5[Name]</option>\n";
   }
   echo "
      </select>";
?>
</td>
</tr>
</tr>
<tr><td><input type="Submit" name="" value="Suche starten"></td></tr>
</table>
</form>
</td>
<td>&nbsp;</td>
<td valign="top">
<form action="xflur_selekt.php" method="post" target="">
<table border="1" bgcolor="#F3CAB4" >
<tr  style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Flur suchen</td></tr>
<tr style="font-family:Arial; font-size: 10pt; font-weight: bold"><td>Thema<br>
Siedlungsmessungen</td></tr>
<tr>
<td style="font-family:Arial; font-size: 10pt; font-weight: bold">
<input  type="Radio" name="fselekt" value="60" checked>Fluren mit Siedlungsmessungen<br>
<input  type="Radio" name="fselekt" value="61">berechnet durch Werkvertrag<br>
</td>

</td>
</tr>
</tr>
<tr><td><input type="Submit" name="" value="Suche starten"></td></tr>
</table>
</form>
</td>
</tr>
</table>

<?php

?>