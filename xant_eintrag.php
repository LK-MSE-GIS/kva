<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
xnav_ant();
echo "<div style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
if ((strpos($abteilung,"new") > -1) OR (strpos($abteilung,"adm") > -1))
  {
	echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
	 
  echo "<form action=\"ant_einfuegen.php\" method=\"post\" target=\"\">
  <table border=\"1\" >
  <tr bgcolor=\"#a0a0a0\">
   <td colspan=\"4\"> Antrag einf&uuml;gen</td>
   </tr>
   <tr bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Eilig</td>
   </tr>
   <tr>
   <td> <select name=\"vermst_id\">";

   $query="SELECT * FROM vermst WHERE liste='1' ORDER BY vermst";
   $result=mysqli_query($db_link,$query);

   while($r=mysqli_fetch_array($result))
     {
     echo "<option value=\"$r[vermst_id]\">$r[vermst]</option>\n";
      }

    echo "</select>
    </td>
    <td><input type=\"Text\" name=\"az\" value=\"\" size=\"10\" maxlength=\"25\"> </td>
    <td> <select name=\"vermart_id\">";

   $query="SELECT * FROM vermart ORDER BY vermart_id";
   $result=mysqli_query($db_link,$query);

    while($r=mysqli_fetch_array($result))
     {
      echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
     }

    echo "</select>
    </td>
    <td><select name=\"hurry\" size=\"\">
    <option value=\"0\" selected>nein</option>
    <option value=\"1\">ja</option>
    </select></td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurst&uuml;ck</td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_1\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result=mysqli_query($db_link,$query);

     while($r=mysqli_fetch_array($result))
      {
       echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_1\" value=\"\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_1alt\" cols=\"40\" rows=\"2\"></textarea><br>
    <textarea name=\"flst_1\" cols=\"40\" rows=\"2\"></textarea>
    </td>
    </tr>
    <tr>
     <td> <select name=\"gemark_id_2\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
    $result=mysqli_query($db_link,$query);

     while($r=mysqli_fetch_array($result))
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
    $result=mysqli_query($db_link,$query);

     while($r=mysqli_fetch_array($result))
      {
       echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
       }

    echo "</select><br><br>
    <input type=\"Text\" name=\"flur_3\" value=\"\" size=\"10\" maxlength=\"10\">
    </td>
    <td align=\"right\" valign=\"top\">alt:<br><br>neu:</td>
    <td colspan=\"2\"><textarea name=\"flst_3alt\" cols=\"40\" rows=\"2\"></textarea><br>
    <textarea name=\"flst_3\" cols=\"40\" rows=\"2\"></textarea>
    </td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"4\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"4\"><input type=\"Text\" name=\"sv\" value=\"\" size=\"100\" maxlength=\"100\"> </td>
    </tr>
     <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"4\">Koordinate</td>
    </tr>
    <tr>
    <td colspan=\"4\">Rechts:<input type=\"int\" name=\"rechts\" value=\"\" size=\"7\" maxlength=\"7\"> &nbsp;
    Hoch:<input type=\"int\" name=\"hoch\" value=\"\" size=\"7\" maxlength=\"7\"> </td>
    </tr>
    <tr bgcolor=\"#a0a0a0\">
    <td colspan=\"2\">Eingangsdatum: </td>
    <td colspan=\"2\">Wo ist die Akte ?</td>
    </tr>
    <tr>";

    $datum = getdate(time());
    $year=$datum["year"];
    $month=$datum["mon"];
    $day=$datum["mday"];
    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    $eintrag=$year."-".$month."-".$day;

    echo" <td colspan=\"2\"><input type=\"date\" name=\"eing_datum\" value=\"$eintrag\" size=\"10\" maxlength=\"10\"></td>";

    echo "<td>
    <select name=\"aktort_id\">";

    $query="SELECT * FROM aktort ORDER BY aktort_id";
    $result=mysqli_query($db_link,$query);

    while($r=mysqli_fetch_array($result))
     {
      echo "<option value=\"$r[aktort_id]\">$r[aktort]</option>\n";
     }

     echo "</select>
     </td>

     </tr>
     <tr>
     <td colspan=\"6\" bgcolor=\"#a0a0a0\"> <input type=\"Submit\" name=\"\" value=\"Antrag eintragen\">&nbsp;&nbsp;<input type=\"reset\"></td>

     </tr>
     </table>
     </form>
	 </div>";
 }
 else
 {
 echo "<br><br>Sie sind nicht berechtigt neue Vermessungsanträge anzulegen!
       <br><br> <img src=\"images/error.jpg\"  border=\"0\" width=\"300\"> <br>" ;
 }
  echo "</div>";
xnav_ant();
bottom();
?>