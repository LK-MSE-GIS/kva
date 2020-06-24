<?php
include ("connect.php");
include ("function.php");
head_flur();
nav_flur("alkgrund");

?>
<HTML>
<HEAD>

<SCRIPT language="javascript">

function feldleer_kontrolle(wert)
{
/* Diese Funktion überprüft, ob der übergebene Wert leer ist */
if (wert=="")  {
   return false;
  }
else  {
   return true;
  }
}

function gmk_kontrolle(wert)
{
/* Diese Funktion überprüft, ob der übergebene Wert leer ist */
if (wert=="0")  {
   return false;
  }
else  {
   return true;
  }
}

function Check_Ausw()
 {
 if(document.Formular1.gemkg_id1.options[1].selected == true)
  {
    alert("Das würde ich nicht tun!");
  }
  return true;
 }

function globale_kontrolle()
{
/* Die globale Kontroll-Funktion. Sie überprüft, ob alle Pflichtfelder des Formulars ausgefüllt sind. Falls ja, erfolgt der Rückgabewert true, ansonsten eine Fehlermeldung und der Rückgabewert false. Zur Kontrolle, ob ein Feld gefüllt ist, wird die Funktion feldleer_kontrolle aufgerufen, der das entsprechende Formularfeld als Parameter übergeben wird. */
// Anzahl der nicht gefüllten Felder
var fehlerzahl = 0; 
var fehlermeldung = "Achtung! Bitte beachten Sie:\n";

if (feldleer_kontrolle(document.Formular1.gemkg_id2.value))
{
  if (gmk_kontrolle(document.Formular1.gemkg_id1.value))
  {
  fehlerzahl = fehlerzahl + 1;
  fehlermeldung = fehlermeldung + " Bite geben Sie entweder einen Gemarkungsnamen\noder\neine Gemarkungsnummer an";
  }
}

if (!feldleer_kontrolle(document.Formular1.gemkg_id2.value))
{
  if (!gmk_kontrolle(document.Formular1.gemkg_id1.value))
  {
  fehlerzahl = fehlerzahl + 1;
  fehlermeldung = fehlermeldung + " Sie sollten doch lieber etwas eingebn...";
  }
}

if (fehlerzahl == 0)
{
  return true;  // Keine Fehler gefunden
}
else   // Fehler vorhanden
{
  
  alert(fehlermeldung);
  return false;
}
}

function sicher()
  {
   return window.confirm("Wollen Sie wirklich abbrechen?");
  }

</SCRIPT>
</HEAD>
<BODY>
<font face="Arial"><h1>Flurdatenbank</h1>

<form action="flur_suchen_id.php" method="post" name="Formular1" onSubmit="return globale_kontrolle()" onReset="return sicher()">
<table border="1" style="font-family:Arial; font-size: 10pt; font-weight: italic">
<tr bgcolor="#76AAC9">
<td colspan="2"><b>Suche über die Gemarkung</b></td>
</tr>
<tr bgcolor="#76AAC9">
 <td>Gemarkunganame</td>
 <td>Gemarkungsnr.: (6-stellig)</td>
 </tr>
<tr>
<td> <select name="gemkg_id1" onChange='document.forms[0].submit()'>
 <?php
 $query="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }
?>
</select>

<td><input type="text" name="gemkg_id2" value="" size="6" maxlength="6"></td>
 

<tr>
 <td colspan="2" bgcolor="#76AAC9"> <input type="Submit" name="" value="Suche starten" onClick='kontrolle()'>&nbsp;&nbsp;<input type="reset" ></td>

</tr>
</table>
</form>

<br>
<br>



<?php

nav_flur("alkgrund");
bottom();
?>