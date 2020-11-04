<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
xnav_ant();
/*--------------------------------------------------------------------*/


$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM antrag as a, fluren2antrag as b WHERE a.id=$id AND a.id=b.antrag";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
nav_aendern($id,$db_link,$page,$status);

echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";

  echo "
  <input type=hidden name=\"what\" value=\"edit\">
  <input type=hidden name=\"id\" value=$id>
  <input type=hidden name=\"status\" value=$status>

  <table class=\"alter_eintrag_table\" border=\"0\" >
  <tr style=\"font-weight: bold\">
   <td> alten Antrag bearbeiten</td>
   <td colspan=\"3\">$r[number]&nbsp;<b>/</b>&nbsp;$r[year] &nbsp;";
   if ($r["lk"]=='Ro') echo "Landkreis Röbel";
   if ($r["lk"]=='Wa') echo "Landkreis Waren";
   if ($r["lk"]=='Mu') echo "Landkreis Müritz";
   if ($r["lk"]=='Mc') echo "Landkreis Malchin";
   if ($r["lk"]=='Nz') echo "Landkreis Neustrelitz";
   echo "&nbsp;&nbsp;ÄN: <input type=\"Text\" name=\"ueb_aen\" value=\"$r[ueb_aen]\" size=\"9\" maxlength=\"9\"> </td>
   </tr>
   <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
   <td></td>
   </tr>
   <tr>
   <form action=\"xant_umaendern_main.php\" method=\"post\" target=\"\">
   <td> 
		<select name=\"vermst_id\">";

   $query="SELECT * FROM vermst  ORDER BY vermst";
   $result2=mysqli_query($db_link,$query);

   while($r2=mysqli_fetch_array($result2))
     {
     echo "<option value=\"$r2[vermst_id]\"";
      if ($r2["vermst_id"] == $r["vermst_id"]) echo " selected";
     echo ">$r2[vermst]</option>\n";
      }

    echo "</select>
    </td>
    <td><input type=\"Text\" name=\"az\" value=\"$r[az]\" size=\"10\" maxlength=\"25\"> <input type=\"hidden\" name=\"ida\" value=\"$id\" size=\"10\" maxlength=\"25\"></td>
    <td> <select name=\"vermart_id\">";

   $query="SELECT * FROM vermart ORDER BY vermart_id";
   $result3=mysqli_query($db_link,$query,);

    while($r3=mysqli_fetch_array($result3))
     {
      echo "<option value=\"$r3[vermart_id]\"";
    if ($r3["vermart_id"] == $r["vermart_id"]) echo " selected";
    echo ">$r3[vermart]</option>\n";
     }

    echo "</select>
		<td><input type=\"date\" name=\"ueb_datum\" value=\"$r[ueb_datum]\" size=\"10\" maxlength=\"25\"> <input type=\"hidden\" name=\"ida\" value=\"$id\" size=\"10\" maxlength=\"25\"> </td>
		<td><input type=\"Submit\" name=\"\" value=\"Änderung speichern\" formaction=\"xant_umaendern_main.php?page=$page&status=$status\"></td>
			</form>";
	 
/*------------ANZEIGEN VON FORHANDENEN DATENSÄTZEN------------*/


	$querydaten="SELECT b.gemarkung_id, b.flur, b.flst_alt, b.flst_neu, b.id FROM antrag as a, fluren2antrag as b WHERE a.id=$id AND a.id=b.antrag";
    $resultd=mysqli_query($db_link,$querydaten);
     while($rd=mysqli_fetch_array($resultd))
      {
       echo "
    <tr class=\"alter_eintrag_beschriftung\" bgcolor=\"#a0a0a0\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurstück</td>
	<td></td>
    </tr>
    <tr>
     <td>";
	 
	 $querygemark="SELECT * FROM gemarkung WHERE gemark_id = $rd[gemarkung_id]";
	 $resultgemark=mysqli_query($db_link,$querygemark);
	 $rg=mysqli_fetch_array($resultgemark);
	 
	   echo " <form method=\"post\" target=\"\"> 
	   <input type=\"Text\" name=\"gemarkung_id\" value=\"$rd[gemarkung_id]\" size=\"5\" maxlength=\"25\"> $rg[gemarkung]<br><br>
    Flur: <input type=\"Text\" name=\"flur\" value=\"$rd[flur]\" size=\"1\" maxlength=\"25\">
    </td>
    <td align=\"right\" valign=\"top\"></td>
    <td colspan=\"1\">alt: <input type=\"Text\" name=\"flst_alt\" value=\"$rd[flst_alt]\" size=\"15\" maxlength=\"25\"><br>
    neu: <input type=\"Text\" name=\"flst_neu\" value=\"$rd[flst_neu]\" size=\"15\" maxlength=\"25\">
	
	 <input type=\"hidden\" name=\"id\" value=\"$rd[id]\">
	
	<td></td>
	<td><input type=\"Submit\" name=\"speichern\" value=\"Änderung speichern\" formaction=\"xant_umaendern.php?ido=$id&page=$page&status=$status\"><br><input type=\"Submit\" name=\"loeschen\" value=\"Gemarkung löschen\" formaction=\"xant_gemarkung_del.php?ido=$id&page=$page&status=$status\" onclick=\"return confirm('Die Gemarkung wirklich löschen?')\"></td>
    </td>
    </tr>
	</form>
        <tr>
	 <td>Sachverhalt</td>
    </tr>
    <tr>
    <td colspan=\"4\"><input type=\"Text\" name=\"sv\" value=\"$r[sv]\" size=\"100\" maxlength=\"100\"> </td>";
       }
	 
	
   if ((strpos($abteilung,"old") > -1) OR (strpos($abteilung,"adm") > -1))
      { 
      echo "<tr>
     <td colspan=\"6\" class=\"alter_eintrag_beschriftung\" style=\"height: 50px;\"> ";
	 
	 $querydel="SELECT * FROM antrag as a, fluren2antrag as b WHERE a.id = $id AND a.id = b.antrag";
	 $resultdel=mysqli_query($db_link,$querydel);
	 $rd=mysqli_fetch_array($resultdel);
	 
	   echo "
	 
	 <a class=\"alter_eintrag_button\" href=\"xant_eintrag_hist.php?lk=$rd[lk]&number=$rd[number]&year=$rd[year]&vermst_id=$rd[vermst_id]&vermart_id=$rd[vermart_id]&az=$rd[az]&ueb_datum=$rd[ueb_datum]&gemark_id_1=$rd[gemarkung_id]\">+Gemarkung hinzufügen</a>";
	 
	 
     if ((strpos($abteilung,"adm") > 0) OR (strpos($abteilung,"old") > 0)) echo "<a class=\"x_button\"href= \"xant_hist_del.php?id=$id&page=$page&status=$status\">X</a>";
     echo "</td>
     </tr>";
    }

	
	
    echo " </table>";

?>