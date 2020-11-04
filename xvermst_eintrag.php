<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
nav_vermst();
?>

<form action="vermst_eintrag_einfuegen.php" method="post" target="">
<div class="ausgabe_bereich">
  <!-----------Überschrift----------->
<font face="Arial"><h1>Vermessungsstelle einfügen</h1></font>
</div>
<div class="ausgabe_bereich">

<table border="1" >

<tr>
 <td bgcolor="#a0a0a0" width="250">Vermessungsstelle</td>
 <td><input type="Text" name="vermst" value="" size="50" maxlength="50"> </td>
 </tr>
<tr>
<td bgcolor="#a0a0a0">Ansprechpartner</td>
<td><input type="Text" name="contact" value="" size="50" maxlength="50"></td>
</tr>
<tr >
 <td bgcolor="#a0a0a0"> Stra&szlig;e</td>
 <td><input type="Text" name="strasse" value="" size="50" maxlength="50"> </td>
</tr>
<tr>
<td bgcolor="#a0a0a0">PLZ</td>
<td><input type="Text" name="plz" value="" size="5" maxlength=5""></td>
 </tr>
<tr>
 <td bgcolor="#a0a0a0">Ort </td>
 <td><input type="Text" name="ort" value="" size="50" maxlength="50"> </td>
</tr>
<tr>
 <td bgcolor="#a0a0a0">Telefon </td>
 <td><input type="Text" name="telefon" value="" size="20" maxlength="20"> </td>
</tr>
<tr>
 <td bgcolor="#a0a0a0">FAX </td>
 <td><input type="Text" name="fax" value="" size="20" maxlength="20"> </td>
</tr>
<tr>
 <td bgcolor="#a0a0a0">E-Mail </td>
 <td><input type="Text" name="email" value="" size="70" maxlength="70"> </td>
</tr>
<tr>
<td bgcolor="#a0a0a0">in Auswahlliste aufnehmen?</td>
<td><select name="liste">
   <option selected value="0">nein</option>
   <option value="1">ja</option>
   </select></td>
</tr>
</tr>
<td bgcolor="#a0a0a0">Werkvertragspartner</td>
<td><select name="wvp">
   <option selected value="0">nein</option>
   <option value="1">ja</option>
   </select></td>
</tr>
<tr>
 <td colspan="3" bgcolor="#a0a0a0"> <input type="Submit" name="" value="Senden">&nbsp;&nbsp;<input type="reset"></td>
</tr>

</table>
</form>
</div>

<?php
nav_vermst();
bottom();
?>