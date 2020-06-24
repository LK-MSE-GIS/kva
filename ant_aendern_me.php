<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();

if ((strpos($abteilung,"me") > -1) OR (strpos($abteilung,"adm") > -1)) $me =1;

$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

$query="SELECT o.*, x.* FROM antrag as o, antrag_extra as x  WHERE o.id=$id  AND o.id=x.id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
if($r[id]>0)
{
$aktenz=$r[number]."/".substr($r[year],2,2);
echo" <div style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
<form action=\"ant_aendern_einfuegen_me.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"status\" value=\"$status\">";
echo "<input type=hidden name=\"page\" value=\"$page\">";

nav_aendern($id,$dbname,$page,$status);


echo "<table bgcolor=\"#80FFFF\" border=\"1\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr>
<td colspan=\"4\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> Messungseingang&nbsp;&nbsp;$aktenz&nbsp;</td></tr>
<tr bgcolor=\"#80FFFF\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
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
echo "<tr bgcolor=\"#80FFFF\">
 <td>Messeingang </td>
 <td>Mitarbeiter</td>
 <td>Aktenort</td>
 <td>Eingang Ok?</td>
</tr>
<tr>

 <td><input type=\"date\" name=\"me_datum\" value=\"$r[me_datum]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=ant_aendern_me.php&table=antrag&column=me_datum&page=$page&status=$status\"><img src=\"images/buttons/b_calendar.png\" alt=\"aktuelles Datum eintragen\" border=\"0\"></a> </td>
 <td><select name=\"me_mit_id\" onChange='document.forms[0].submit()'>";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%me%'";
 $result2=mysql_query($query2,$db_link);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option";
   if($r2[mitarb_id] == $r[me_mit_id])
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
   <td><select name=\"me_ja_nein\" onChange='document.forms[0].submit()'>
   <option";
   if($r[me_ja_nein]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option";
   if($r[me_ja_nein]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>


   </select></td>
</tr>
<tr bgcolor=\"#80FFFF\">
 <td colspan=\"4\">Bemerkungen/Zurück/STORNO </td>
</tr>
<tr>
 <td colspan=\"4\"><textarea name=\"me_comment\" cols=\"60\" rows=\"4\">$r[me_comment]</textarea> </td>
 </tr>
<tr bgcolor=\"#80FFFF\">
 <td colspan=\"4\">fehlende Unterlagen </td>
</tr>
<tr>
 <td colspan=\"4\"><textarea name=\"me_fehlend\" cols=\"60\" rows=\"3\">$r[me_fehlend]</textarea> </td>
 </tr>";

   echo "<tr>
   <td colspan=\"5\" bgcolor=\"#80FFFF\"> <input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\">&nbsp;&nbsp;<input type=\"reset\">&nbsp;
   </td>
   </tr>";

 echo "</table>";
}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
}
echo "</form>";
echo "</div>";
nav_ant();
bottom();
?>