<SCRIPT language="javascript">
function sicher()
  {
   return window.confirm("Soll der Antrag wirklich gelöscht werden?");
  }

</SCRIPT>



<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();



$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
nav_aendern_alt($id,$dbname,$page,$status);

echo "<div style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";

  echo "<form action=\"ant_einfuegen_hist.php\" method=\"post\" target=\"\">
  <input type=hidden name=\"what\" value=\"edit\">
  <input type=hidden name=\"id\" value=$id>
  <input type=hidden name=\"status\" value=$status>

  <table border=\"1\" >
  <tr bgcolor=\"#a0a0a0\">
   <td> alten Antrag bearbeiten</td>
   <td colspan=\"3\">$r[number]&nbsp;<b>/</b>&nbsp;$r[year] &nbsp;";
   if ($r[lk]=='Ro') echo "Landkreis Röbel";
   if ($r[lk]=='Wa') echo "Landkreis Waren";
   if ($r[lk]=='Mu') echo "Landkreis Müritz";
   if ($r[lk]=='Mc') echo "Landkreis Malchin";
   if ($r[lk]=='Nz') echo "Landkreis Neustrelitz";
   echo "&nbsp;&nbsp;ÄN: <input type=\"Text\" name=\"ueb_aen\" value=\"$r[ueb_aen]\" size=\"9\" maxlength=\"9\"> </td>
   </tr>
   <tr bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
   </tr>
   <tr>
   <td> <select name=\"vermst_id\">";

   $query="SELECT * FROM vermst  ORDER BY vermst";
   $result2=mysql_query($query,$db_link);

   while($r2=mysql_fetch_array($result2))
     {
     echo "<option value=\"$r2[vermst_id]\"";
      if ($r2[vermst_id] == $r[vermst_id]) echo " selected";
     echo ">$r2[vermst]</option>\n";
      }

    echo "</select>
    </td>
    <td><input type=\"Text\" name=\"az\" value=\"$r[az]\" size=\"10\" maxlength=\"25\"> </td>
    <td> <select name=\"vermart_id\">";

   $query="SELECT * FROM vermart ORDER BY vermart_id";
   $result3=mysql_query($query,$db_link);

    while($r3=mysql_fetch_array($result3))
     {
      echo "<option value=\"$r3[vermart_id]\"";
    if ($r3[vermart_id] == $r[vermart_id]) echo " selected"; 
    echo ">$r3[vermart]</option>\n";
     }

    echo "</select>
    </td>
    <td><input type=\"date\" name=\"ueb_datum\" value=\"$r[ueb_datum]\" size=\"10\" maxlength=\"10\"></td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurst&uuml;ck</td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_1\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result4=mysql_query($query,$db_link);

     while($r4=mysql_fetch_array($result4))
      {
       echo "<option value=\"$r4[gemark_id]\"";
       if ($r4[gemark_id] == $r[gemark_id_1]) echo " selected";
       echo ">$r4[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_1\" value=\"$r[flur_1]\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_1alt\" cols=\"40\" rows=\"2\">$r[flst_1alt]</textarea><br>
    <textarea name=\"flst_1\" cols=\"40\" rows=\"2\">$r[flst_1]</textarea><br><br>

    
    </td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_2\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result5=mysql_query($query,$db_link);

     while($r5=mysql_fetch_array($result5))
      {
       echo "<option value=\"$r5[gemark_id]\"";
       if ($r5[gemark_id] == $r[gemark_id_2]) echo " selected";
       echo ">$r5[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_2\" value=\"$r[flur_2]\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_2alt\" cols=\"40\" rows=\"2\">$r[flst_2alt]</textarea><br>
    <textarea name=\"flst_2\" cols=\"40\" rows=\"2\">$r[flst_2]</textarea><br><br>

    </td>
    </tr>        
    <tr>
     <td> <select name=\"gemark_id_3\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result6=mysql_query($query,$db_link);

     while($r6=mysql_fetch_array($result6))
      {
       echo "<option value=\"$r6[gemark_id]\"";
       if ($r6[gemark_id] == $r[gemark_id_3]) echo " selected";
       echo ">$r6[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_3\" value=\"$r[flur_3]\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_3alt\" cols=\"40\" rows=\"2\">$r[flst_3alt]</textarea><br>
    <textarea name=\"flst_3\" cols=\"40\" rows=\"2\">$r[flst_3]</textarea><br><br>

    
    </td>
    </tr> 
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"6\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"6\"><input type=\"Text\" name=\"sv\" value=\"$r[sv]\" size=\"100\" maxlength=\"100\"> </td>
    </tr>";   
   if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
      { 
      echo "<tr>
     <td colspan=\"6\" bgcolor=\"#a0a0a0\"> <input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;&nbsp;<input type=\"reset\">";
     if ((strpos($abteilung,"adm") > 0) OR (strpos($abteilung,"old") > 0)) echo "<a href= \"ant_hist_del.php?id=$id&page=$page&status=$status\"> <img src=\"images/buttons/b_drop.png\" border=\"0\" alt =\"Antrag entfernen\" onClick=\"return sicher()\"></a>";
     echo "</td>
     </tr>";
    }
    echo " </table>
     </form>";
 
  

