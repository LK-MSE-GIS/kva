<?php
include ("connect.php");
include ("function.php");

head_order();
nav_orders();
echo "<font face=\"Arial\">";

$datum = getdate(time());
$year=$datum[year];
$month=$datum[mon];
$day=$datum[mday];

if (strlen($month) == 1) $month='0'.$month;
$localtime= substr($year,2,2).$month;

 while (strlen($day) < 2)
        {
          $day='0'.$day;
        }
$order_date=$year.'-'.$month.'-'.$day;

?>

<form action="order_find.php" method="post" target="">
<h3>Auftrag suchen&nbsp;</h3>
<table>
<tr>
<td valign="top">
<table border="0">
<td>Antragsnummer:</td>
<td><input type="Text" name="order_key" value="" size="" maxlength=""></td>
<tr>
<td>Auftraggeber:</td>
<td><input type="Text" name="order_addr1" value="" size="40" maxlength="40"></td>
</tr>
<tr>
<td>Auftragsstatus:
</td>
<td>
<select name="order_status">
<option value="0" checked></option>
<option value="1">eingegangen</option>
<option value="9">Angebot erstellt</option>
<option value="2">abgearbeitet,noch keine Rechnung</option>
<option value="3">abgearbeitet, wartet auf Bezahlung</option>
<option value="4">abgeschlossen</option>
</select>
</td>
</tr>
<tr>
<td>Bearbeiter:</td>
</td>
<?php
echo" <td><select name=\"mit_id\">";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ord%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "</select>";
?>
   </td>
</tr>
<tr>
<td>Rechnungsnr.:</td>
<td><input type="Text" name="calc_number" value="" size="12" maxlength="12"></td>
</tr>
<tr>
<td>Vorkasse:</td>
<td><select name="calc_prep">
<option value="0" selected>&nbsp;</option>
<option value="1">nein</option>
<option value="2">ja</option>
</select></td>
</tr>
</table>
<br>
<br>
<table border="0">
<tr>
<td>ausgeliefert von:</td>
<td><input type="date" name="delivery_date_from" value="" size="10" maxlength="10"></td>
<td>bis:</td>
<td><input type="date" name="delivery_date_to" value="" size="10" maxlength="10"></td>
</tr>
<tr>
<td >eingegangen von:</td>
<td><input type="date" name="order_date_from" value="" size="10" maxlength="10"></td>
<td >bis:</td>
<td><input type="date" name="order_date_to" value="" size="10" maxlength="10"></td>
</tr>
</table>
</td>
<td>&nbsp;&nbsp;</td>
<td>
Was wurde bestellt?
<table>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td><input type="Checkbox" name="fka3" value="ja"></td>
<td>Flurkartenausz&uuml;ge</td>
<td><input type="Checkbox" name="fkpl" value="ja"></td>
<td>Flurkarten-Plot</td>
</tr>
<tr>
<td><input type="Checkbox" name="fkma" value="ja"></td>
<td>Flurkarten mit Ma&szlig;en</td>
<td><input type="Checkbox" name="bsk" value="ja"></td>
<td>Bodensch&auml;tzungskarten</td>
</tr>
<tr>
<td><input type="Checkbox" name="lbwz" value="ja"></td>
<td>Liste BWZ</td>
<td><input type="Checkbox" name="aeg" value="ja"></td>
<td>Alteigent&uuml;mer</td>
</tr>
<tr>
<td><input type="Checkbox" name="lgbn" value="ja"></td>
<td>Liste GB-Blatt-Nr.</td>
<td><input type="Checkbox" name="kfb" value="ja"></td>
<td>Kopie Flurbuch</td>
</tr>
<tr>
<td><input type="Checkbox" name="kbb" value="ja"></td>
<td>Kopie Bestandsbl&auml;tter</td>
<td><input type="Checkbox" name="ksk" value="ja"></td>
<td>Kopie sonst. Unterl.</td>
</tr>
<tr>
<td><input type="Checkbox" name="alba" value="ja"></td>
<td>ALB-Ausz&uuml;ge</td></td>
<td><input type="Checkbox" name="albl" value="ja"></td>
<td>ALB-Listen</td>
</tr>
<tr>
<td><input type="Checkbox" name="wldg" value="ja"></td>
<td>ALB-WLDGE</td>
<td><input type="Checkbox" name="excel" value="ja"></td>
<td>ALB-EXCEL</td>
</tr>
<tr valign="top">
<td><input type="Checkbox" name="edbs" value="ja"></td>
<td>ALK-EDBS</td>
<td><input type="Checkbox" name="shape" value="ja"></td>
<td>ALK-Shape</td>
</tr>

<tr>
<td><input type="Checkbox" name="kvwmap" value="ja"></td>
<td>kvwmap-Nutzung</td></td>
<td><input type="Checkbox" name="dxf" value="ja"></td>
<td>ALK-DXF</td>
</tr>
<tr>
<td><input type="Checkbox" name="tech" value="ja"></td>
<td>Unterlagen f&uuml;r<br> technische Vermessung</td>
<td><input type="Checkbox" name="sonstiges" value="ja"></td>
<td>sonstiges</td>
</tr>

<tr>
<td colspan="4"><br>Gemarkung:&nbsp;
<select name="order_gem_id">
 <?php
 $query="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }
?>
</select>

</td>
</tr>
<tr>
<td colspan="4">Flur:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Text" name="order_flur" value="" size="25" maxlength="25"></td>
</tr>



</table>

</td>
</tr>
</table>
<br>
<br>
<input type="Submit" name="" value="Suche starten">&nbsp;&nbsp;<input type="reset">
</form>
<?php
nav_orders();
bottom();
?>