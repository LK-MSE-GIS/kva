<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("kvwmap");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);

flur_kopf($id,$dbname);
navi_flur("kvwmap",$id);
abhaken($r[ID],$dbname,"80",0);

 echo"</table>";
echo "<form action=\"flur_ins_kvwmap.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">";


echo "<br><table border=\"0\">
<tr style=\"font-family:Blue Highway; font-size: 13pt; \">
<td  bgcolor=\"#D3D1F5\" colspan=\"2\">Rissarchivierung (kvwmap)</td>
<td bgcolor=\"#D3D1F5\">mit KVZ</td>
<td bgcolor=\"#D3D1F5\">Mitarbeiter</td>
</tr>
<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">gescannte Risse (aus GDS) erfasst:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"gesc_riss_dat\" value=\"$r[gesc_riss_dat]\" size=\"10\" ></td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"gesc_riss_kvz\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[gesc_riss_kvz]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[gesc_riss_kvz]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
    <td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"gesc_riss_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[gesc_riss_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">Risse komplett erfasst:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"all_riss_dat\" value=\"$r[all_riss_dat]\" size=\"10\" ></td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"all_riss_kvz\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[all_riss_kvz]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[all_riss_kvz]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>
    <td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"all_riss_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[all_riss_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">Anlagen erfasst am:</td>
<td colspan=\"2\"><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"anlagen_dat\" value=\"$r[anlagen_dat]\" size=\"10\" ></td>
<td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"anlagen_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[anlagen_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">alte Risse georeferenziert am:</td>
<td colspan=\"2\"><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"georef_dat\" value=\"$r[georef_dat]\" size=\"10\" ></td>
<td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"georef_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[georef_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>

<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">GN erfasst am:</td>
<td colspan=\"2\"><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"gn_scan_date\" value=\"$r[gn_scan_date]\" size=\"10\" ></td>
<td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"gn_scan_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[gn_scan_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>

<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">Nachbearbeitung am:</td>
<td colspan=\"2\"><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"nachb_date\" value=\"$r[nachb_date]\" size=\"10\" ></td>
<td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"nachb_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[nachb_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr>
<td  style=\"font-family:Blue Highway; font-size: 13pt; \" width=\"300\" bgcolor=\"#EDECFB\">Erfassung Nachweise am:</td>
<td colspan=\"2\"><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"erf_nachweise_date\" value=\"$r[erf_nachweise_date]\" size=\"10\" ></td>
<td>
    <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"        name=\"erf_nachweise_mitarbeiter\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ris%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[erf_nachweise_mitarbeiter])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
</table>

<br>
<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
echo "<br><br>";



nav_flur("kvwmap");
bottom();
?>