<?php
include ("connect.php");
include ("function.php");


$id=$_GET["id"];

$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);

$extraquery="SELECT * FROM antrag_extra WHERE id=$id";
$extraresult=mysql_query($extraquery,$db_link);
$extrar=mysql_fetch_array($extraresult);

$aktenz=$r[number]."/".substr($r[year],2,2);

 $xquery="SELECT * FROM vermart WHERE vermart_id =$r[vermart_id]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $vermart=$xr[vermart];

 $xquery="SELECT * FROM vermst WHERE vermst_id =$r[vermst_id]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $vermst=$xr[vermst];


 $xquery="SELECT * FROM gemarkung WHERE gemark_id =$r[gemark_id_1]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $gemark1=$xr[gemarkung];

if ($r[gemark_id_2] > 0)
 {
 $xquery="SELECT * FROM gemarkung WHERE gemark_id =$r[gemark_id_2]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $gemark2=$xr[gemarkung];
 }

if ($r[gemark_id_3] > 0)
 {
 $xquery="SELECT * FROM gemarkung WHERE gemark_id =$r[gemark_id_3]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $gemark3=$xr[gemarkung];
 }


if ($extrar[vorb_mit_id] > 0)
 {
 $xquery="SELECT * FROM mitarbeiter WHERE mitarb_id =$extrar[vorb_mit_id]";
 $xresult=mysql_query($xquery,$db_link);
 $xr=mysql_fetch_array($xresult);
 $vorbmit=$xr[name];
 }

echo "<div style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">
<table>
<tr>
<td width=\"150\" align=\"left\">Begleitblatt</td>
<td style=\"font-family:Arial; font-size: 16pt; font-weight: bold\">$aktenz</td>
<td width=\"300\" align=\"right\">$vermart</td>
</tr>
<tr>
<td colspan=\"3\" style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">Sachverhalt: $r[sv]</td></tr>
</table><hr style=\"color:#000000; height:3px; \">";

echo "<table>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"300\">Vermessungsstelle</td>
<td width=\"300\">Aktenzeichen</td>
<td width=\"300\">Eingangsdatum</td>
<td width=\"300\">�nderungsnachweisnummer</td>
</tr>
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">
<td>$vermst</td>
<td>$r[az]</td>
<td>$r[eing_datum]</td>
<td></td>
</tr>
</table><hr>";


echo "<table>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"800\">Gemarkung</td>
<td width=\"200\">Flur</td>
<td width=\"300\">Flurst�cke (alt)</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td><b>$gemark1 ($r[gemark_id_1])</b></td>
<td>$r[flur_1]</td>
<td>$r[flst_1alt]</td>
</tr>";

if ($r[gemark_id_2] > 0)
 {
echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td><b>$gemark2 ($r[gemark_id_2])</b></td>
<td>$r[flur_2]</td>
<td>$r[flst_2alt]</td>
</tr>";
}


if ($r[gemark_id_3] > 0)
 {
echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td><b>$gemark3 ($r[gemark_id_3])</b></td>
<td>$r[flur_3]</td>
<td>$r[flst_3alt]</td>
</tr>";
}

echo "</table><hr>";

echo "<table><tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td width=\"200\">Punktreservierung</td>
<td width=\"30\"><input type=\"Checkbox\"></td>
<td width=\"200\">ja, siehe Anlage</td>
<td width=\"30\"><input type=\"Checkbox\"></td>
<td>nein</td>
</tr></table><hr>";

echo "<table><tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td width=\"200\">vorbereitet am: ";
if ($r[vorb_datum] != '0000-00-00') echo "<b>$r[vorb_datum]</b>";
echo "</td>
<td width=\"200\">durch: <b>$vorbmit</b></td>
<td>Geb�hr:</td>
</tr>
</table><hr>";


echo "<table><tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td width=\"250\">Rechnungsnummer:</td>
<td width=\"150\">Datum:</td>
<td>Mitarb.:</td>
</tr>
</table><hr style=\"color:#000000; height:3px; \">";


echo "<table><tr style=\"font-family:Arial; font-size: 10pt; font-weight: normal\">
<td width=\"300\">zur �bername erhalten am:</td>
<td>Mitarb.:</td>
</tr>
</table><hr style=\"color:#000000; height:3px; \">";


echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Kontrolle auf Vollst�ndigkeit</td>
<td width=\"100\" align=\"center\">vorh.</td>
<td width=\"100\" align=\"center\">nicht vorh.</td>
<td width=\"150\" align=\"center\">Beanstandungen<br>Wiedereingang am:</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">�bernahmeantrag (Bodenwert, Geb�udewert, Kostenpflichtiger angegeben)</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Fortf�hrungsriss(e)</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Grenzniederschrift</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Fl�chenberechnungsheft/L-Beleg</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Koordinatenverzeichnis und Berechnungen</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Nachweis der Messwerte (Soll-Ist-Vergleich)</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Lageplan/Plot im Ma�stab der Flurkarte und 1:1000</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">vorbereitete Unterlagen</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Vollst�ndigkeit gepr�ft</td>
<td width=\"100\" style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Datum:</td>
<td width=\"250\" colspan=\"2\" style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Bearbeiter:</td>
</tr>
</table><br>";

echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Kontrolle des Vorhandenseins der notwendigen Unterschriften und Pr�fvermerke</td>
<td width=\"100\" align=\"center\">vorh.</td>
<td width=\"100\" align=\"center\">zur�ck wegen M�ngeln</td>
<td width=\"150\" align=\"center\">Beanstandunden<br>Wiedereingang am:</td>
</tr>
</table>";
echo "<table border=\"0\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: bold\">";

if ($r[vermart_id] == '1' OR $r[vermart_id] == '2' OR $r[vermart_id] == '6' OR $r[vermart_id] == '15')
 echo "<td colspan=\"4\">Grenzniederschriften</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Unterschriften Beteiligte/Bevollm�chtigte/<br>Beurkundende</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Vollmachten</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Grenzfeststellungs- und<br>Abmarkungsmitteilungen</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>";

echo "<tr style=\"font-family:Arial; font-size: 8pt; font-weight: bold\">
<td colspan=\"4\">Fortf�hrungsriss</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Best�tigung der Richtigkeit</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">verwendete Vermessungsunterlagen</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Nordpfeil</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Flurst�cke richtig dargestellt und bezeichnet</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Stra�enname, Hausnummer, Objektschl�ssel vorh.</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Anschlussflurst�cke dargestellt</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">LG und LZ gepr�ft</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Pr�fung auf doppelte Festpunkte</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: bold\">
<td colspan=\"4\">Fl�chenberechnung</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Unterschriften bei der Berechnung</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Unterschriften bei der Pr�fung</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Bescheinigung der Richtigkeit</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Rest durch Abzug zul�ssig</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Nutzungsartengrenzen dargestellt<br>(�bereinstimmung mit dem Riss)</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"350\">Lagebezeichnung</td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"100\" align=\"center\"><input type=\"Checkbox\"></td>
<td width=\"150\" align=\"center\">&nbsp;</td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Zur �bernahme geeignet</td>
<td width=\"100\" style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Datum:</td>
<td width=\"250\" colspan=\"2\" style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Bearbeiter:</td>
</tr>
</table><br>";

echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td colspan=\"2\">�bernahme in die ALK-Datenbank</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">�bernahme in die Datenbank</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">�berpr�fung auf geometrische und fachliche Fehler</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Datum:</td>
<td width=\"400\" align=\"left\">Bearbeiter:</td>
</tr>
</table><br>";


echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">�bernahme analoges Kataster</td>
<td width=\"200\" align=\"center\">Einarbeitung durchgef�hrt</td>
<td width=\"200\" align=\"center\">�nderungen gepr�ft</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Nummerierung Fortf�hrungsriss</td>
<td align=\"center\"><input type=\"Checkbox\"></td>
<td align=\"center\"><input type=\"Checkbox\"></td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Pr�fung der ALK</td>
<td align=\"center\"><input type=\"Checkbox\"></td>
<td align=\"center\"><input type=\"Checkbox\"></td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Erstellung Fortf�hrungsbeleg L</td>
<td align=\"center\"><input type=\"Checkbox\"></td>
<td align=\"center\"><input type=\"Checkbox\"></td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Aufstellung der Kostenrechnung</td>
<td align=\"center\"><input type=\"Checkbox\"></td>
<td align=\"center\"><input type=\"Checkbox\"></td>
</tr>

<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Inhalts�bersicht fortgef�hrt</td>
<td align=\"center\"><input type=\"Checkbox\"></td>
<td align=\"center\"><input type=\"Checkbox\"></td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td></td>
<td  style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Datum:</td>
<td  style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Datum:</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td>Eintragung in Antragsdatenbank</td>
<td  style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Bearbeiter:</td>
<td  style=\"font-family:Arial; font-size: 6pt; font-weight: normal\">Bearbeiter:</td>
</tr>
</table><br>";

echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td colspan=\"2\">�bernahme in das ALB</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Kontrolle Fortf�hrungsbeleg L</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">ALB eingeben</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Durchlauf gepr�ft</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Datum:</td>
<td width=\"400\" align=\"left\">Bearbeiter:</td>
</tr>
</table><br>";

echo "<table border=\"1\" cellspacing=\"0\" bordercolor=\"#C6C2C1\"><tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td colspan=\"2\">Geb�hrenbescheid</td>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Geb�hrenbescheid erstellt</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Antragsdatenbank aktualisiert</td>
<td width=\"400\" align=\"center\"><input type=\"Checkbox\"></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 8pt; font-weight: normal\">
<td width=\"400\">Datum:</td>
<td width=\"400\" align=\"left\">Bearbeiter:</td>
</tr>
</table><br>";
bottom();
?>