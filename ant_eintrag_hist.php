<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();

if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
{

echo "<div style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
  {
  echo "<form action=\"ant_einfuegen_hist.php\" method=\"post\" target=\"\">
  <input type=hidden name=\"what\" value=\"insert\">
  <table border=\"1\" >
  <tr bgcolor=\"#a0a0a0\">
   <td> Antrag einf&uuml;gen</td>
   <td colspan=\"3\"><input type=\"Text\" name=\"number\" value=\"\" size=\"4\" maxlength=\"4\">&nbsp;<b>/</b>&nbsp;<input type=\"Text\" name=\"year\" value=\"\" size=\"4\" maxlength=\"4\">&nbsp;Landkreis:
   <select name=\"lk\">
   <option value=\"Mu\">M&uuml;ritz</option>
   <option value=\"Ro\">R&ouml;bel</option>
   <option value=\"Wa\">Waren</option>
   <option value=\"Nz\">Neustrelitz</option>
   <option value=\"Mc\">Malchin</option>
   </select>&nbsp;&nbsp;ÄG: <input type=\"Text\" name=\"ueb_aen\" value=\"\" size=\"9\" maxlength=\"9\">
    </td>
   </tr>
   <tr bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
   </tr>
   <tr>
   <td> <select name=\"vermst_id\">";

   $query="SELECT * FROM vermst WHERE liste='1' ORDER BY vermst";
   $result=mysql_query($query,$db_link);

   while($r=mysql_fetch_array($result))
     {
     echo "<option value=\"$r[vermst_id]\">$r[vermst]</option>\n";
      }

    echo "</select>
    </td>
    <td><input type=\"Text\" name=\"az\" value=\"\" size=\"10\" maxlength=\"25\"> </td>
    <td> <select name=\"vermart_id\">";

   $query="SELECT * FROM vermart ORDER BY vermart_id";
   $result=mysql_query($query,$db_link);

    while($r=mysql_fetch_array($result))
     {
      echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
     }

    echo "</select>
    </td>
    <td><input type=\"date\" name=\"ueb_datum\" value=\"\" size=\"10\" maxlength=\"10\"></td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurst&uuml;ck</td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_1\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result=mysql_query($query,$db_link);

     while($r=mysql_fetch_array($result))
      {
       echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_1\" value=\"\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_1alt\" cols=\"40\" rows=\"2\"></textarea><br>
    <textarea name=\"flst_1\" cols=\"40\" rows=\"2\"></textarea><br>
    </td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_2\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result=mysql_query($query,$db_link);

     while($r=mysql_fetch_array($result))
      {
       echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_2\" value=\"\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_2alt\" cols=\"40\" rows=\"2\"></textarea><br>
    <textarea name=\"flst_2\" cols=\"40\" rows=\"2\"></textarea>
    </td>
    </tr>
        <tr>
     <td> <select name=\"gemark_id_3\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result=mysql_query($query,$db_link);

     while($r=mysql_fetch_array($result))
      {
       echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_3\" value=\"\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_3alt\" cols=\"40\" rows=\"2\"></textarea><br>
    <textarea name=\"flst_3\" cols=\"40\" rows=\"2\"></textarea>
    <br>
    </td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"6\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"6\"><input type=\"Text\" name=\"sv\" value=\"\" size=\"100\" maxlength=\"100\"> </td>
    </tr>
     <tr>
     <td colspan=\"6\" bgcolor=\"#a0a0a0\"> <input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;&nbsp;<input type=\"reset\"></td>

     </tr>
     </table>
     </form>";
 }
 else
 {
 echo "<br><br>Sie sind nicht berechtigt neue Vermessungsanträge anzulegen!
       <br><br> <img src=\"images/error.jpg\"  border=\"0\" width=\"300\"> <br>" ;
 }
  echo "</div>";


}
else echo "Sie haben keinen Zugriff auf diese Funktion";

  nav_ant();
  bottom();
?>