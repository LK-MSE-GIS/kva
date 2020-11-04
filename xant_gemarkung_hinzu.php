<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
xnav_ant();

$id=$_GET["id"];
$lk=$_GET["lk"];
$number=$_GET["number"];
$year=$_GET["year"];
$vermst_id=$_GET["vermst_id"];
$az=$_GET["az"];
$vermart_id=$_GET["vermart_id"];
$ueb_datum=$_GET["ueb_datum"];
$gemark_id_1=$_GET["gemark_id_1"];

if (empty($lk))
{
if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
{

if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
  {
	  echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
  echo "<form action=\"xant_einfuegen_gemarkung.php\" method=\"post\" target=\"\">
  <input type=hidden name=\"what\" value=\"insert\">
  <p style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">Alten Antrag einfügen</p>
  <table class=\"alter_eintrag_table\" border=\"0\" >
  <tr style=\"font-weight: bold\">
   <td style=\"text-align:right; padding-right:10px\">Antragsnummer</td>
   <td colspan=\"3\"><input type=\"Text\" name=\"number\" value=\"\" size=\"4\" maxlength=\"4\">&nbsp;<b>/</b>&nbsp;<input type=\"Text\" name=\"year\" value=\"\" size=\"4\" maxlength=\"4\">&nbsp;Landkreis:
   <select name=\"lk\">
   <option value=\"Mu\">Müritz</option>
   <option value=\"Ro\">Röbel</option>
   <option value=\"Wa\">Waren</option>
   <option value=\"Nz\">Neustrelitz</option>
   <option value=\"Mc\">Malchin</option>
   </select>&nbsp;&nbsp;ÄG: <input type=\"Text\" name=\"ueb_aen\" value=\"\" size=\"9\" maxlength=\"9\">
    </td>
   </tr>
   <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
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
    <td><input type=\"date\" name=\"ueb_datum\" value=\"\" size=\"10\" maxlength=\"10\"></td>
    </tr>
    <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurstück</td>
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
     <td>";
    echo "
    <tr class=\"alter_eintrag_beschriftung\">
    <td colspan=\"6\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"6\"><input type=\"Text\" name=\"sv\" value=\"\" size=\"100\" maxlength=\"100\"> </td>
    </tr>
     <tr>
     <td colspan=\"6\" class=\"alter_eintrag_beschriftung\"> <input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;&nbsp;<input type=\"reset\"></td>

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
}

/*------------FORMULAR MIT INHALT------------*/


else {
	echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
  echo "<form action=\"xant_gemarkung_hinzufuegen.php?id=$id\" method=\"post\" target=\"\">
  <input type=hidden name=\"what\" value=\"insert\">
  <p style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">Gemarkung hinzufügen</p>
  <table class=\"alter_eintrag_table\" border=\"0\" >
  <tr style=\"font-weight: bold\">
   <td> Antrag einfügen</td>
   <input type=hidden name=\"number\" value=\"$number\">
   <input type=hidden name=\"year\" value=\"$year\">
   <input type=hidden name=\"lk\" value=\"$lk\">
   <input type=hidden name=\"vermart_id\" value=\"$vermart_id\">
   <input type=hidden name=\"vermst_id\" value=\"$vermst_id\">
   <td colspan=\"3\">&nbsp;$number&nbsp;<b>/</b>&nbsp;$year&nbsp;&nbsp;&nbsp;&nbsp;Landkreis:
   &nbsp;$lk&nbsp;&nbsp;&nbsp;&nbsp;ÄG: <input type=\"Text\" name=\"ueb_aen\" value=\"\" size=\"9\" maxlength=\"9\">
    </td>
   </tr>
   <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
   </tr>
   
   
   
   <tr>
   <td>";

   $query="SELECT * FROM vermst WHERE vermst_id=$vermst_id";
   $result=mysqli_query($db_link,$query);
	$r=mysqli_fetch_array($result);
	
     echo "$r[vermst]";


    echo "
    </td>
    <td>$az</td>
    <td>";

   $query="SELECT * FROM vermart WHERE vermart_id=$vermart_id";
   $result=mysqli_query($db_link,$query);

    while($r=mysqli_fetch_array($result))
     {
      echo "<option value=\"$r[vermart_id]\">$r[vermart]</option>\n";
     }

    echo "
    </td>
    <td>$ueb_datum</td>
    </tr>";
	
	
/*------------ANZEIGEN VON FORHANDENEN DATENSÄTZEN------------*/


	$querydaten="SELECT * FROM antrag as a, fluren2antrag as b WHERE a.number='$number' AND a.year='$year' AND a.lk Like '$lk' AND a.id = b.antrag";
    $resultd=mysqli_query($db_link,$querydaten);
     while($rd=mysqli_fetch_array($resultd))
      {
       echo "
    <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurstück</td>
    </tr>
    <tr>
     <td> $rd[gemarkung_id]";
	 
	 $querygemark="SELECT * FROM gemarkung WHERE gemark_id = $rd[gemarkung_id]";
	 $resultgemark=mysqli_query($db_link,$querygemark);
	 while($rg=mysqli_fetch_array($resultgemark))
	 
	   echo " $rg[gemarkung]<br><br>
    Flur: $rd[flur]
    </td>
    <td align=\"right\" valign=\"top\"></td>
    <td colspan=\"2\">alt: $rd[flst_alt]<br>
    neu: $rd[flst_neu]
    </td>
    </tr>
        <tr>
     <td>";
       }
	
	
	
	echo "
    <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurstück</td>
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
     <td>";
    echo "
    <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
    <td colspan=\"6\">Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"6\"><input type=\"Text\" name=\"sv\" value=\"\" size=\"100\" maxlength=\"100\"> </td>
    </tr>
     <tr>
     <td colspan=\"6\" class=\"alter_eintrag_beschriftung\"> <input type=\"Submit\" name=\"\" value=\"Hinzufügen\">&nbsp;&nbsp;<input type=\"reset\"></td>

     </tr>
     </table>
     </form>
</div>";}

  xnav_ant();
  bottom();
?>