<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
xnav_ant();

if ((strpos($abteilung,"vorb") > -1) OR (strpos($abteilung,"adm") > -1)) $vorb =1;

$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

$query="SELECT o.*, x.* FROM antrag as o, antrag_extra as x  WHERE o.id=$id  AND o.id=x.id";

$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
if($r["id"]>0)
{
$aktenz=$r["number"]."/".substr($r["year"],2,2);
echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
echo"<div style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
<form action=\"ant_aendern_einfuegen_vorb.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"status\" value=\"$status\">
<input type=hidden name=\"number\" value=\"$r[number]\">
<input type=hidden name=\"year\" value=\"$r[year]\">";
echo "<input type=hidden name=\"page\" value=\"$page\">";


nav_aendern($id,$db_link,$page,$status);

echo "<table><tr>";
if ($r["gemark_id_1"] != '0') echo "<td><a href=\"ant_vorb_list.php?gemark_id=$r[gemark_id_1]&flur_id=$r[flur_1]\" target =\"about_blank\">Liste für ",get_gemark_name( $r["gemark_id_1"],$db_link),"&nbsp;Flur:$r[flur_1]</a></td><td>&nbsp;</td> ";

if ($r["gemark_id_2"] != '0') echo "<td><a href=\"ant_vorb_list.php?gemark_id=$r[gemark_id_2]&flur_id=$r[flur_2]\" target =\"about_blank\">Liste für ",get_gemark_name( $r["gemark_id_2"],$db_link),"&nbsp;Flur:$r[flur_2]</a></td><td>&nbsp;</td> ";

if ($r["gemark_id_3"] != '0') echo "<td><a href=\"ant_vorb_list.php?gemark_id=$r[gemark_id_3]&flur_id=$r[flur_3]\" target =\"about_blank\">Liste für ",get_gemark_name( $r["gemark_id_3"],$db_link),"&nbsp;Flur:$r[flur_3]</a></td> ";

echo "</tr></table><br>";


echo "<table border=\"1\" style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
<tr bgcolor=\"#F1F464\">
<td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> Vorbereitung&nbsp;&nbsp;$aktenz&nbsp;</td>
   <td colspan=\"3\">
   <input type=button value=\"Begleitblatt erstellen\" onClick='window.open(\"ant_begleitblatt.php?id=$id\",\"Begleitblatt\",\"location=no,resizable=yes,scrollbars=yes\")'></td></tr>
<tr bgcolor=\"#F1F464\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr>";
$query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysqli_query($db_link,$query10);
     $r10=mysqli_fetch_array($result10);
     echo"<td>$r10[vermst],&nbsp;</td>";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysqli_query($db_link,$query12);
     $r12=mysqli_fetch_array($result12);
     echo"<td>$r12[vermart],&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
     echo"<td>$r11[gemarkung]&nbsp;($r[gemark_id_1])";
 if ($r["flur_1"]!="") echo ",&nbsp;Flur: $r[flur_1]";
 if ($r["flst_1alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_1alt"],0,10),"</td></tr>";

if ($r["gemark_id_2"] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_2]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_2])";
 if ($r["flur_2"]!="") echo ",&nbsp;Flur: $r[flur_2]";
 if ($r["flst_2alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_2alt"],0,10),"</td></tr>";
 }

if ($r["gemark_id_3"] != 0)
  {
 echo "<tr><td>&nbsp;</td><td>&nbsp;</td>";
$query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_3]";
     $result11=mysqli_query($db_link,$query11);
     $r11=mysqli_fetch_array($result11);
echo "<td>$r11[gemarkung]&nbsp;($r[gemark_id_3])";
 if ($r["flur_3"]!="") echo ",&nbsp;Flur: $r[flur_3]";
 if ($r["flst_3alt"]!="") echo ",&nbsp;Flurst.:",showarray($r["flst_3alt"],0,10),"</td></tr>";
 }

 echo "</table></td>
</tr>";

 echo "<tr bgcolor=\"#F1F464\">
 <td>Vorb.-datum </td>
 <td>Mitarbeiter</td>
 <td colspan=\"2\">Aktenort</td>
</tr>
<tr>

 <td><input type=\"date\" name=\"vorb_datum\" value=\"$r[vorb_datum]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_vorb.php&table=antrag&column=vorb_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a></td>
 <td><select name=\"vorb_mit_id\" onChange='document.forms[0].submit()'> ";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vorb%'";
 $result2=mysqli_query($db_link,$query2);

 while($r2=mysqli_fetch_array($result2))
   {
   echo "<option";
   if($r2["mitarb_id"] == $r["vorb_mit_id"])
   {
   echo " selected";
   }
   echo " value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "
      </select>
   </td>
   <td colspan=\"2\"><select name=\"aktort_id\" onChange='document.forms[0].submit()'>";

 $query5="SELECT * FROM aktort ORDER BY aktort_id";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option";
   if($r5["aktort_id"] == $r["aktort_id"])
   {
   echo " selected";
   }
   echo " value=\"$r5[aktort_id]\">$r5[aktort]</option>\n";
   }
   echo "
      </select>
   </td>
</tr>
<tr bgcolor=\"#F1F464\">
 <td colspan=\"4\">Unterlagen </td>
</tr>
<tr>
 <td colspan=\"4\"><textarea name=\"vorb_unterl\" cols=\"80\" rows=\"3\">$r[vorb_unterl]</textarea> </td>
 </tr>
 <tr bgcolor=\"#F1F464\">
 <td>Rechn.-datum</td>
 <td>Kassenzeichen </td>
 <td>Betrag </td>
 <td>Vorbereitung OK?</td>
</tr>
<tr>
 <td><input type=\"Text\" name=\"vorb_re_datum\" value=\"$r[vorb_re_datum]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_vorb.php&table=antrag_extra&column=vorb_re_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td><input type=\"Text\" name=\"vorb_kassz\" value=\"$r[vorb_kassz]\" size=\"20\" maxlength=\"20\"> </td>
 <td><input type=\"float\" name=\"vorb_betrag\" value=\"$r[vorb_betrag]\" size=\"12\" maxlength=\"12\"> </td>
   <td><select name=\"vorb_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r["vorb_ja_nein"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r["vorb_ja_nein"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
   <option";
   if($r["vorb_ja_nein"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">keine Vorbereitung</option>
   </select></td>
</tr>";

  echo "<tr>
 <td colspan=\"5\" bgcolor=\"#F1F464\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
 </td>

</tr>";
 
 echo "</table>";
}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
}
echo "</form></div></div>";

xnav_ant();
bottom();
?>