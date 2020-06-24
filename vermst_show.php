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
<table border=\"0\" >
<tr>
 <td bgcolor=\"#a0a0a0\" width=\"250\">Vermessungsstelle</td>
 <td>$r[vermst] </td>
 </tr>
<tr>
<td bgcolor=\"#a0a0a0\">Ansprechpartner</td>
<td>$r[contact]</td>
</tr>
<tr >
 <td bgcolor=\"#a0a0a0\"> Stra&szlig;e</td>
 <td>$r[strasse] </td>
</tr>
<tr>
<td bgcolor=\"#a0a0a0\">PLZ</td>
<td>$r[plz]</td>
 </tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Ort </td>
 <td>$r[ort]</td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Telefon </td>
 <td>$r[telefon] </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">FAX </td>
 <td>$r[fax]</td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">E-Mail </td>
 <td>$r[email]</td>
</tr>
</table>";

nav_vermst();
bottom();
?>