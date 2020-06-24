<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();

if ((strpos($abteilung,"rech") > -1) OR (strpos($abteilung,"adm") > -1)) $rech =1;

$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

$nachfolger=$id+1;
$vorgaenger=$id-1;

$query="SELECT o.*,x.* FROM antrag as o, antrag_extra as x  WHERE o.id=$id  AND o.id=x.id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
if($r[id]>0)
{
$aktenz=$r[number]."/".substr($r[year],2,2);
echo"
<form action=\"ant_aendern_einfuegen_rech.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"status\" value=\"$status\">";
echo "<input type=hidden name=\"page\" value=\"$page\">";
nav_aendern($id,$dbname,$page,$status);



echo "<table border=\"1\">
<tr bgcolor=\"#A3A39E\">
<td colspan=\"5\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> Rechnungen&nbsp;&nbsp;$aktenz&nbsp;</td></tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"5\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr>";
$query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysql_query($query10,$db_link);
     $r10=mysql_fetch_array($result10);
     echo"<td>$r10[vermst],&nbsp;</td>";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysql_query($query12,$db_link);
     $r12=mysql_fetch_array($result12);
     echo"<td>$r12[vermart],&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
     echo"<td>$r11[gemarkung]&nbsp;($r[gemark_id_1])";
 if ($r[flur_1]!="") echo ",&nbsp;Flur: $r[flur_1]";
 if ($r[flst_1alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_1alt],0,10),"</td></tr>";

if ($r[gemark_id_2] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_2]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_2])";
 if ($r[flur_2]!="") echo ",&nbsp;Flur: $r[flur_2]";
 if ($r[flst_2alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_2alt],0,10),"</td></tr>";
 }

if ($r[gemark_id_3] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_3]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_3])";
 if ($r[flur_3]!="") echo ",&nbsp;Flur: $r[flur_3]";
 if ($r[flst_3alt]!="") echo ",&nbsp;Flurst.:",showarray($r[flst_3alt],0,10),"</td></tr>";
 }

 echo "</table></td>
</tr>";

echo "<tr bgcolor=\"#A3A39E\">
 <td>Antrag</td>
  <td>Bearbeiter</td>
 <td>Aktenort</td>
 <td>Rechnungen OK?</td>
 </tr>
 <tr>
 <td>$r[id]</td>
 <td><select name=\"re_mit_id\" onChange='document.forms[0].submit()'>";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%rech%'";
 $result2=mysql_query($query2,$db_link);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option";
   if($r2[mitarb_id] == $r[re_mit_id])
   {
   echo " selected";
   }
   echo " value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "
      </select>
   </td>
   <td><select name=\"aktort_id\" onChange='document.forms[0].submit()'>";

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
      </td>
      <td><select name=\"re_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r[re_ja_nein]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r[re_ja_nein]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   <option";
   if($r[re_ja_nein]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">keine Rechnung</option>
   </select></td>
</tr>
</table>
<br>
<table>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Rechnung 1</td>
</tr>
<tr bgcolor=\"#A3A39E\">
 <td>Datum</td>
 <td>Betrag </td>
 <td>Kassenzeichen</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"re_rech1\" value=\"$r[re_rech1]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_rech.php&table=antrag_extra&column=re_rech1&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a></td>
 <td> <input type=\"float\" name=\"re_betrag1\" value=\"$r[re_betrag1]\" size=\"15\" maxlength=\"15\"></td>
 <td><input type=\"text\" name=\"re_kz1\" value=\"$r[re_kz1]\" size=\"15\" maxlength=\"15\"></td>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Empf&auml;nger</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_empf1\" cols=\"69\" rows=\"5\">$r[re_empf1]</textarea></td>
</tr>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Unterlagen an</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_unterl1\" cols=\"69\" rows=\"5\">$r[re_unterl1]</textarea></td>
</tr>";


  echo " <tr>
 <td colspan=\"3\" bgcolor=\"#A3A39E\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";
 
echo "</tr>
</table><br>

<table>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Rechnung 2</td>
</tr>
<tr bgcolor=\"#A3A39E\">
 <td>Datum</td>
 <td>Betrag </td>
 <td>Kassenzeichen</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"re_rech2\" value=\"$r[re_rech2]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_rech.php&table=antrag_extra&column=re_rech2&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td> <input type=\"float\" name=\"re_betrag2\" value=\"$r[re_betrag2]\" size=\"15\" maxlength=\"15\"></td>
 <td><input type=\"text\" name=\"re_kz2\" value=\"$r[re_kz2]\" size=\"15\" maxlength=\"15\"></td>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Empf&auml;nger</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_empf2\" cols=\"69\" rows=\"5\">$r[re_empf2]</textarea></td>
</tr>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Unterlagen an</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_unterl2\" cols=\"69\" rows=\"5\">$r[re_unterl2]</textarea></td>
</tr>";


  echo " <tr>
 <td colspan=\"3\" bgcolor=\"#A3A39E\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";

echo "</tr>
</table><br>
<table>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Rechnung 3</td>
</tr>
<tr bgcolor=\"#A3A39E\">
 <td>Datum</td>
 <td>Betrag </td>
 <td>Kassenzeichen</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"re_rech3\" value=\"$r[re_rech3]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_rech.php&table=antrag_extra&column=re_rech3&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td> <input type=\"float\" name=\"re_betrag3\" value=\"$r[re_betrag3]\" size=\"15\" maxlength=\"15\"></td>
 <td><input type=\"text\" name=\"re_kz3\" value=\"$r[re_kz3]\" size=\"15\" maxlength=\"15\"></td>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Empf&auml;nger</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_empf3\" cols=\"69\" rows=\"5\">$r[re_empf3]</textarea></td>
</tr>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Unterlagen an</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_unterl3\" cols=\"69\" rows=\"5\">$r[re_unterl3]</textarea></td>
</tr>";


  echo " <tr>
 <td colspan=\"3\" bgcolor=\"#A3A39E\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";

echo "</tr>
</table><br>
<table>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Rechnung 4</td>
</tr>
<tr bgcolor=\"#A3A39E\">
 <td>Datum</td>
 <td>Betrag </td>
 <td>Kassenzeichen</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"re_rech4\" value=\"$r[re_rech4]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_rech.php&table=antrag_extra&column=re_rech4&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td> <input type=\"float\" name=\"re_betrag4\" value=\"$r[re_betrag4]\" size=\"15\" maxlength=\"15\"></td>
 <td><input type=\"text\" name=\"re_kz4\" value=\"$r[re_kz4]\" size=\"15\" maxlength=\"15\"></td>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Empf&auml;nger</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_empf4\" cols=\"69\" rows=\"5\">$r[re_empf4]</textarea></td>
</tr>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Unterlagen an</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_unterl4\" cols=\"69\" rows=\"5\">$r[re_unterl4]</textarea></td>
</tr>";


  echo " <tr>
 <td colspan=\"3\" bgcolor=\"#A3A39E\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";

echo "</tr>
</table><br>
<table>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Rechnung 5</td>
</tr>
<tr bgcolor=\"#A3A39E\">
 <td>Datum</td>
 <td>Betrag </td>
 <td>Kassenzeichen</td>
</tr>
<tr>
 <td><input type=\"date\" name=\"re_rech5\" value=\"$r[re_rech5]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_rech.php&table=antrag_extra&column=re_rech5&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td> <input type=\"float\" name=\"re_betrag5\" value=\"$r[re_betrag5]\" size=\"15\" maxlength=\"15\"></td>
 <td><input type=\"text\" name=\"re_kz5\" value=\"$r[re_kz5]\" size=\"15\" maxlength=\"15\"></td>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Empf&auml;nger</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_empf5\" cols=\"69\" rows=\"5\">$r[re_empf5]</textarea></td>
</tr>
</tr>
<tr bgcolor=\"#A3A39E\">
<td colspan=\"3\">Unterlagen an</td>
</tr>
<tr>
<td colspan=\"3\"><textarea name=\"re_unterl5\" cols=\"69\" rows=\"5\">$r[re_unterl5]</textarea></td>
</tr>";


  echo " <tr>
 <td colspan=\"3\" bgcolor=\"#A3A39E\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>";


echo "</tr>
</table>";
}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
}
echo "</form>";
echo "<a href=\"ant_searchlist.php?page=$page&highlight=$id\"><img src=\"images/buttons/back.png\" alt=\"Zur&uuml;ck zur aktuellen Suche\" border=\"0\" width=\"120\"></a>&nbsp;&nbsp;";
echo "<br><div align=\"center\">";

echo "<a href=\"ant_aendern_rech.php?id=$vorgaenger&page=$page\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"80\"></a>&nbsp;&nbsp;
 <a href=\"ant_aendern_rech.php?id=$nachfolger&page=$page\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"80\"></a></a></a></div><br> <br> ";


nav_ant();
bottom();
?>