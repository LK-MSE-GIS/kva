<?php
include ("connect.php");
include ("function.php");

head_vermst();
nav_vermst();

$vermst_id=$_GET["vermst_id"];
$query="SELECT * FROM vermst WHERE vermst_id=$vermst_id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);
echo"
<form action=\"vermst_aendern_einfuegen.php\" method=\"post\" target=\"\">
<input type=hidden name=\"vermst_id\" value=\"$vermst_id\">
<table border=\"1\" >

<tr>
 <td bgcolor=\"#a0a0a0\" width=\"250\">Vermessungsstelle</td>
 <td><input type=\"Text\" name=\"vermst\" value=\"$r[vermst]\" size=\"50\" maxlength=\"50\"> </td>
 </tr>
<tr>
<td bgcolor=\"#a0a0a0\">Ansprechpartner</td>
<td><input type=\"Text\" name=\"contact\" value=\"$r[contact]\" size=\"50\" maxlength=\"50\"></td>
</tr>
<tr >
 <td bgcolor=\"#a0a0a0\"> Stra&szlig;e</td>
 <td><input type=\"Text\" name=\"strasse\" value=\"$r[strasse]\" size=\"50\" maxlength=\"50\"> </td>
</tr>
<tr>
<td bgcolor=\"#a0a0a0\">PLZ</td>
<td><input type=\"Text\" name=\"plz\" value=\"$r[plz]\" size=\"5\" maxlength=\"5\"></td>
 </tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Ort </td>
 <td><input type=\"Text\" name=\"ort\" value=\"$r[ort]\" size=\"50\" maxlength=\"50\"> </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Telefon </td>
 <td><input type=\"Text\" name=\"telefon\" value=\"$r[telefon]\" size=\"20\" maxlength=\"20\"> </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">FAX </td>
 <td><input type=\"Text\" name=\"fax\" value=\"$r[fax]\" size=\"20\" maxlength=\"20\"> </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">E-Mail </td>
 <td><input type=\"Text\" name=\"email\" value=\"$r[email]\" size=\"70\" maxlength=\"70\"> </td>
</tr>
<tr>
<td bgcolor=\"#a0a0a0\">in Auswahlliste aufnehmen?</td>
<td><select name=\"liste\">
   <option";
   if($r[liste]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r[liste]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>


   </select></td>
</tr>
<tr>
<td bgcolor=\"#a0a0a0\">Werkvertragspartner</td>
<td><select name=\"wvp\">
   <option";
   if($r[wvp]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r[wvp]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>


   </select></td>
</tr>
<tr>
 <td colspan=\"3\" bgcolor=\"#a0a0a0\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderung abschicken\">&nbsp;&nbsp;<input type=\"reset\"></td>

</tr>
</table>
</form>";

nav_vermst();
bottom();
?>