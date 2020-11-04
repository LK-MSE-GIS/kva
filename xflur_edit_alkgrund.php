<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();
nav_flur("alkgrund");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);


flur_kopf($id,$db_link);
navi_flur("alk_grund",$id);
abhaken($r["ID"],$db_link,"80",0);


echo "</table><br>
<form action=\"flur_ins_alkgrund.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">

<table>
<tr>
<td>
<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#DFE4C2\" colspan=\"2\">ALK - Grundstufe</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">BVVG-Plandatum:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"bvvg\" value=\"$r[bvvg]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">fehlerfrei &uuml;bernommen:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"fehlerf_dat\" value=\"$r[fehlerf_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">ALK-Projekt-Datum:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alk_projekt_dat\" value=\"$r[alk_projekt_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">Offenlegung:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"off_datum\" value=\"$r[off_datum]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">Datenbank-Datum:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"db_datum\" value=\"$r[db_datum]\" size=\"10\" ></td>
</tr>
</table>
<br>
<table>
<tr>
<td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">BOV:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bov\">";

 $query5="SELECT * FROM bov ORDER by name";
 $result5=mysqli_query($query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[bov_id] == $r[bov])
   {
   echo " selected";
   }
   echo " value=\"$r5[bov_id]\">$r5[Name]</option>\n";
   }
   echo "
      </select>
 </td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">nur teilweise:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bov_teilw\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["bov_teilw"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[bov_teilw]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
</tr>
</table>
<table>
<tr>
<td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">Geb&auml;udebestand vorhanden:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"geb\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["geb"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[geb]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
</tr>
<tr>
<td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">Siedlungsmessung:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"siedlmes\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["siedlmes"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[siedlmes]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[siedlmes]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">berechnet</option>
    </select></td>
</tr>
<tr>
<td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">gesperrt wegen aktivem Werkvertrag:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"barrier\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["barrier"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[barrier]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
</tr>
</table>";

echo "<table>
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td>Vertrags-ID:</td>
<td><input type=\"text\" name=\"vertrag_id\" value=\"$r[vertrag_id]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td>Entstehung der ALK:</td>
<td><input type=\"text\" name=\"vertrag\" value=\"$r[vertrag]\" size=\"60\" ></td>
</tr>
</table>";

echo "<br><div align=\"center\">
<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
echo "<br><br>";


?>