<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];
$error=$_GET["error"];

head_li_a();

if ($error >= 100) echo "Die angegebene Antragsnummer existiert nicht.<br>";
if ($error !=0) echo "Es fehlen wichtige Eingaben.<br>";
echo "<div align=\"center\"><h3>Datensatz bearbeiten</h3></div>";
$query="SELECT * from li_a where id='$id';";
$result=mysql_query($query);
$r=mysql_fetch_array($result);

echo "<form action=\"li_a_editins.php\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"id\" value=\"$id\" >
<input type=\"hidden\" name=\"number\" value=\"$r[number]\" >
<input type=\"hidden\" name=\"year\" value=\"$r[year]\" >

<table>
<tr>
<td width=\"250\">Auftragsnummer:</td>
<td>$r[number]</td>
</tr>
<tr>
<td>Antragsnummer:</td>
<td><input type=\"int\" name=\"antrag\" value=\"$r[antrag]\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Verm.art:</td>
<td>";


 $query2="SELECT * FROM vermart where  vermart_id=$r[vermart_id]";
 $result2=mysql_query($query2);
 $r2=mysql_fetch_array($result2);

   echo "$r2[vermart]";

 echo "</td>
<tr>
<td valign=\"top\">
Flurst&uuml;ck(e)
</td>
<td>
<input type=\"Text\" name=\"flst1\" value=\"$r[flst1]\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst2\" value=\"$r[flst2]\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst3\" value=\"$r[flst3]\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst4\" value=\"$r[flst4]\" size=\"18\" maxlength=\"18\">
</td>
</tr>
<tr>
<td>Datum:</td>";
if ($r[vorb_date] == '0000-00-00')
 {
  $vorgabe=$print_datum;
 }
 else
 {
  $vorgabe=$r[vorb_date];
 }

echo "<td><input type=\"date\" name=\"vorb_date\" value=\"$vorgabe\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"vorb_mit_id\">";
 if ($r[vorb_mit_id] =='0')
    {
     $vorg_mit_id=$mitarb_id;
    }
    else
    {
     $vorg_mit_id=$r[vorb_mit_id];
     }
 $query3="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result3=mysql_query($query3);

 while($r3=mysql_fetch_array($result3))
   {
   echo "<option ";
   if ($r3[mitarb_id] == $vorg_mit_id) echo "selected ";
   echo "value=\"$r3[mitarb_id]\">$r3[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>Erf.-Datum:</td>
<td><input type=\"date\" name=\"take_date\" value=\"$r[take_date]\" size=\"10\" maxlength=\"10\"><a href=\"set_date.php?id=$r[id]&script=li_a_edit.php&table=li_a&column=take_date\"><img src=\"images/buttons/b_calendar.png\" alt=\"\" border=\"0\"></a></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"take_mit_id\">";

 $query4="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result4=mysql_query($query4);

 while($r4=mysql_fetch_array($result4))
   {
   echo "<option ";
   if ($r4[mitarb_id] == $r[take_mit_id]) echo "selected ";
   echo "value=\"$r4[mitarb_id]\">$r4[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>Jahrgang:</td>
<td>$r[year]</td>
</tr>
<tr>
<td colspan=\"2\"><br><input type=\"Submit\" name=\"\" value=\"&Auml;nderungen eintragen\"></td>
</tr>
</table>
</form>";




bottom();
?>
