<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();
?>

<font face="Arial"><h1>Antragsdatenbank</h1></font>

<form action="ant_suchen_var.php" method="post" target="">
<table border="1" >
<tr>
 <td colspan="5" bgcolor="#76AAC9" style="font-family:Arial; font-size: 12pt; font-style: italic"> Antrag suchen</td>
</tr>
<tr bgcolor="#76AAC9">
 <td colspan=\"2\">Antragsnummer </td>
 <td colspan="2">Vermessungsstelle</td>
 <td colspan="2">Vermessungsart</td>
 </tr>
 <tr>
 <td><input type="Text" name="number" value="" size="4" maxlength="4">&nbsp;
 <b>/</b>&nbsp;<input type="Text" name="year" value="" size="4" maxlength="4">
 <td colspan="2"> <select name="vermst_id">
 <?php
 $query="SELECT * FROM vermst WHERE liste='1' ORDER BY vermst";
 $result=mysql_query($query,$db_link);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[vermst_id]\">$r[vermst]</option>\n";
   }
?>
</select>
 </td>
 <td colspan="2"> <select name="vermart_id">
 <?php
 $query="SELECT * FROM vermart ORDER BY vermart";
 $result=mysql_query($query,$db_link);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
   }
?>
</select>
 </td>
 </tr>
 <tr bgcolor="#76AAC9">
 <td>Gemarkung</td>
 <td>Flur(en)</td>
 <td>Flurst&uuml;ck(e)</td>
 <td>&nbsp;</td>
 <td></td>
 </tr>
 <tr>
 <td> <select name="gemark_id">
 <?php
 $query="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result=mysql_query($query,$db_link);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }
?>
</select>
 </td>
  <td><input type="Text" name="flur" value="" size="2" maxlength="2"></td>
 <td><input type="Text" name="flst" value="" size="20" maxlength="20"></td>
 <td></td>
 <td></td>
 </tr>
 <tr bgcolor="#76AAC9">
 <td colspan="5">Sachverhalt </td>
 </tr>
  <tr>
 <td colspan="5"><input type="Text" name="sv" value="" size="100" maxlength="100"> </td>
 </tr>
 <tr bgcolor="#76AAC9">
 <td>Wo ist die Akte?</td>
 <td>Az (VmSt.)</td>
 <td colspan="3">Eilig?</td>
 </tr>
 <tr>
 <td><select name="aktort_id">
 <?php
 $query="SELECT * FROM aktort ORDER BY aktort_id";
 $result=mysql_query($query,$db_link);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[aktort_id]\">$r[aktort]</option>\n";
   }
?>
</select>
 </td>
 <td><input type="Text" name="az" value="" size="10" maxlength="10"> </td>
 <td colspan="3"><select name="hurry" size="">
 <option value="" selected>&nbsp;</optin>
 <option value="0">nein</option>
 <option value="1">ja</option>
 </select></td>
 </tr>
 <tr bgcolor="#76AAC9">
 <td>Zeitraum eingrenzen</td>
 <td>von&nbsp;<font size="-2" face="MS Sans Serif">(JJJJ-MM-TT)</font></td>
 <td colspan="3">bis&nbsp;<font size="-2" face="MS Sans Serif">(JJJJ-MM-TT)</font></td>
</tr>
<tr>
  </td>
 <td><select name="datart" size="">
 <option value="eing_datum" selected>Eingangsdatum</option>
 <option value="vorb_datum">Vorbereitung</option>
 <option value="me_datum">Messeingang</option>
 <option value="ueb_datum">&Uuml;bernahme</option>
 <option value="alk_datum">ALK-Datum</option>
 <option value="alb_datum">ALB-Datum</option></select></td>
 <td><input type="date" name="time_von" value="" size="10" maxlength="10"></td>
 <td colspan="3"><input type="Text" name="time_bis" value="" size="10" maxlength="10"></td>
</tr>
<tr>
 <td colspan="5" bgcolor="#76AAC9"> <input type="Submit" name="" value="Suche starten">&nbsp;&nbsp;<input type="reset"></td>
</tr>
</table>
</form>

<?php

nav_ant();
bottom();
?>