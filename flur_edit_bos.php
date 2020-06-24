<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("bos");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);


flur_kopf($id,$dbname);
navi_flur("bos",$id);
abhaken($r[ID],$dbname,"80",0);


echo "</table><br>
<form action=\"flur_ins_bos.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">

<table>
<tr>
<td>
<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#DFE4C2\" colspan=\"2\">Bodensch&auml;tzung</td>
</tr>
<tr>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=\"#DFE4C2\" width=\"250\">Bodensch&auml;tzung existiert</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bos_exists\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[bos_exists]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[bos_exists]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
</tr>

<tr>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=\"#DFE4C2\">Mitarbeiter</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bos_mit_id\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[bos_mit_id])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
 </tr>
 <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#DFE4C2\">&Uuml;bernahme der Bodensch&auml;tzung in die ALK:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"bos_nach_alk\" value=\"$r[bos_nach_alk]\" size=\"10\" ></td>
</tr>
</table>
<br>
<table>
<tr>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=\"#DFE4C2\">Kommentar:</td>
</tr>
<tr>
<td><input type=\"Text\" name=\"bos_comm\" value=\"$r[bos_comm]\" size=\"50\" maxlength=\"50\"></td>
</tr>
</table>
<br>

<table border=\"1\">
<tr>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=\"#DFE4C2\" width=\"400\">Nachsch&auml;tzung vorhanden:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"bos_nachsch\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[bos_nachsch]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[bos_nachsch]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
</tr>


</table>
<br><div align=\"center\">
<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
echo "<br><br></table>";


nav_flur("alkgrund");
bottom();
?>