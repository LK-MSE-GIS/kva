<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();
nav_flur("geb");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);

flur_kopf($id,$db_link);
navi_flur("alk_geb",$id);
abhaken($r["ID"],$db_link,"80",0);

 echo"</table>";

 if ($r["geb"]=='1')
{
 echo"
<form action=\"flur_ins_geb.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">";

echo "<br><table>";


echo "<tr>
<td valign=\"top\">
<table border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\" >
<td bgcolor=\"#949091\" colspan=\"2\" >ALK - Altgeb&auml;udeerfassung</td>
</tr>";



echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">Status</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"altgeb_status\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_status"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">keine Aktion</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_status"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">abgeschlossen</option>
    <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
    if($r["altgeb_status"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">Restmessung KVA</option>
    </select></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">Art der Erfassung:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"altgeb_kartart\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_kartart"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\"></option>
    <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_kartart"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">digitalisiert</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_kartart"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">gemessen</option>
    <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["altgeb_kartart"]==3)
    {
    echo " selected";
    }
    echo " value=\"3\">Luftbildauswertung</option>
    </select></td>

</tr>

<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">Vermessungsstelle:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"altgeb_vermst\">";

 $query6="SELECT * FROM vermst WHERE wvp = '1'";
 $result6=mysqli_query($query6);

 while($r6=mysqli_fetch_array($result6))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r6["vermst_id"] == $r[altgeb_vermst])
   {
   echo " selected";
   }
   echo " value=\"$r6[vermst_id]\">$r6[vermst]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>
<tr>
<td colspan=\"2\"><hr></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">in DB eingearbeitet am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"altgeb_db_dat\" value=\"$r[altgeb_db_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"altgeb_mit_id\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alk%'";
 $result5=mysqli_query($query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["mitarb_id"] == $r[altgeb_mit_id])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>";


echo "</table>
</td>
<td>&nbsp;&nbsp;</td>
<td valign=\"top\">";


echo "<table border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#949091\" colspan=\"2\">ALK - Geb&auml;ude ab 1992</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">MS-BAU-Tabelle vom:&nbsp;</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"geb_mstab_dat\" value=\"$r[geb_mstab_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">aufgefordert am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"geb_auf_dat\" value=\"$r[geb_auf_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#949091\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"geb_abschl_dat\" value=\"$r[geb_abschl_dat]\" size=\"10\" ></td>
</tr>
</table>
</td></tr></table>
</td>
</table>

<br>
<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
}
else
{
  echo "<div align=\"center\">
        <img src=\"images/no_house.jpg\"  border=\"0\" width=\"240\">
  </div>";
}
echo "<br><br>";


nav_flur("geb");
bottom();
?>