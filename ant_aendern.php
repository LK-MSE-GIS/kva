<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();

if ((strpos($abteilung,"grund") > -1) OR (strpos($abteilung,"adm")) > -1) $grund=1;
$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
$aktenz=$r[number]."/".substr($r[year],2,2);
if($r[id]>0)
{

echo"
<form action=\"ant_aendern_einfuegen.php\" method=\"post\" target=\"\">
<div style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"status\" value=\"$status\">";
echo "<input type=hidden name=\"page\" value=\"$page\">";
echo "<input type=hidden name=\"aktenz\" value=\"$aktenz\">";
nav_aendern($id,$dbname,$page,$status);
if ($grund != 1) echo "<br> Der Nutzer $username ist nicht berechtigt Grunddaten zu ändern!<br>";
echo "<table border=\"1\">
   <tr bgcolor=\"#a0a0a0\">
   <td colspan=\"4\"> Antrag $aktenz &auml;ndern</td>
   </tr>
   <tr bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Eilig</td>
   </tr>
   <tr>
   <td> <select name=\"vermst_id\">";

    $query2="SELECT * FROM vermst ORDER BY vermst";
    $result2=mysql_query($query2,$db_link);

    while($r2=mysql_fetch_array($result2))
    {
     echo "<option";
     if($r2[vermst_id] == $r[vermst_id])
      {
       echo " selected";
      }
    echo " value=\"$r2[vermst_id]\">$r2[vermst]</option>\n";
    }
     echo "
      </select>
    </td>
    <td><input type=\"Text\" name=\"az\" value=\"$r[az]\" size=\"10\" maxlength=\"25\"> </td>
    <td> <select name=\"vermart_id\">";

 $query3="SELECT * FROM vermart ORDER BY vermart_id";
 $result3=mysql_query($query3,$db_link);

 while($r3=mysql_fetch_array($result3))
   {
   echo "<option";
   if($r3[vermart_id] == $r[vermart_id])
   {
   echo " selected";
   }
   echo " value=\"$r3[vermart_id]\">$r3[vermart]</option>\n";
   }
   echo "<td>
      <select name=\"hurry\">
   <option";
    if($r[hurry]=="1")
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   <option";
   if($r[hurry]=="0")
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>

   </select>
   </td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurst&uuml;ck</td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_1\">";

 $query4="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result4=mysql_query($query4,$db_link);

 while($r4=mysql_fetch_array($result4))
   {
   echo "<option";
   if($r4[gemark_id] == $r[gemark_id_1])
   {
   echo " selected";
   }
   echo " value=\"$r4[gemark_id]\">$r4[gemarkung]</option>\n";
   }
   echo "
      </select><br><br>
    <input type=\"Text\" name=\"flur_1\" value=\"$r[flur_1]\" size=\"10\" maxlength=\"10\">&nbsp;";
    echo "</td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_1alt\" cols=\"40\" rows=\"2\">$r[flst_1alt]</textarea><br>
    <textarea name=\"flst_1\" cols=\"40\" rows=\"2\">$r[flst_1]</textarea>
    </td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_2\">";

 $query4="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result4=mysql_query($query4,$db_link);

 while($r4=mysql_fetch_array($result4))
   {
   echo "<option";
   if($r4[gemark_id] == $r[gemark_id_2])
   {
   echo " selected";
   }
   echo " value=\"$r4[gemark_id]\">$r4[gemarkung]</option>\n";
   }
   echo "
      </select><br><br>
    <input type=\"Text\" name=\"flur_2\" value=\"$r[flur_2]\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_2alt\" cols=\"40\" rows=\"2\">$r[flst_2alt]</textarea><br>
    <textarea name=\"flst_2\" cols=\"40\" rows=\"2\">$r[flst_2]</textarea>
    </td>
    </tr>
        <tr>
     <td> <select name=\"gemark_id_3\">";

 $query4="SELECT * FROM gemarkung ORDER BY gemarkung";
 $result4=mysql_query($query4,$db_link);

 while($r4=mysql_fetch_array($result4))
   {
   echo "<option";
   if($r4[gemark_id] == $r[gemark_id_3])
   {
   echo " selected";
   }
   echo " value=\"$r4[gemark_id]\">$r4[gemarkung]</option>\n";
   }
   echo "
      </select><br><br>
    <input type=\"Text\" name=\"flur_3\" value=\"$r[flur_3]\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_3alt\" cols=\"40\" rows=\"2\">$r[flst_3alt]</textarea><br>
    <textarea name=\"flst_3\" cols=\"40\" rows=\"2\">$r[flst_3]</textarea>
    </td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"4\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"4\"><input type=\"Text\" name=\"sv\" value=\"$r[sv]\" size=\"100\" maxlength=\"100\"> </td>
    </tr>
    <td colspan=\"4\">Koordinaten&nbsp;&nbsp;Rechts:<input type=\"int\" name=\"rechts\" value=\"$r[rechts]\" size=\"7\" maxlength=\"7\"> &nbsp;
    Hoch:<input type=\"int\" name=\"hoch\" value=\"$r[hoch]\" size=\"7\" maxlength=\"7\"> </td>
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"2\">Eingangsdatum: </td>
    <td colspan=\"2\">Wo ist die Akte ?</td>
    </tr>
    <tr>";

    echo" <td colspan=\"2\"><input type=\"date\" name=\"eing_datum\" value=\"$r[eing_datum]\" size=\"10\" maxlength=\"10\"></td>";

    echo "<td>
    <select name=\"aktort_id\">";

 $query5="SELECT * FROM aktort ORDER BY aktort_id";
 $result5=mysql_query($query5,$db_link);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option";
   if($r5[aktort_id] == $r[aktort_id])
   {
   echo " selected";
   }
   echo " value=\"$r5[aktort_id]\">$r5[aktort]</option>\n";
   }
   echo "
      </select>
     </td>

     </tr>";
if ($grund == 1)
 {
  echo "<tr>
  <td colspan=\"3\" bgcolor=\"#a0a0a0\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
  </td>
  </tr>";
  }
  echo " </table>";

}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
}
echo "</form>";

nav_ant();
bottom();
?>