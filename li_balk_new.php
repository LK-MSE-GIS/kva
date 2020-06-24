<?php
include ("connect.php");
include ("li_function.php");

head_li_balk();

echo "Die letzten 5 Eintr&auml;ge:";
$countquery="SELECT id FROM li_balk";
$recanz=li_count($dbname,$countquery);
$offset=$recanz-5;
if ($recanz < 5) $offset=0;
$query="SELECT * from li_balk  ORDER BY \"year\",\"number\" limit $offset,5;";
$result=mysql_query($query);
echo "<table>
<tr>
<td width=\"100\">Jahrgang</td>
<td width=\"100\">Nummer</td>
<td width=\"160\">Gemarkung</td>
<td width=\"60\">Flur</td>
<td  width=\"200\">Mitarbeiter</td>
<td width=\"100\">Datum</td>
</tr>";
$i=0;
while($r=mysql_fetch_array($result))
  {
    $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
    if ($r[worry]=='1') $Farbe="#F56854";
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td>$r[year]</td>
   <td>$r[number]</td>
   <td>";
   $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
   </td>
   <td>$r[flur_id]</td>
   </td>
   <td>";
   $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mitarb_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]
   </td>
   <td>$r[date]</td>
   </tr>";
  }
 echo "</table>";
$maxquery="SELECT max(number) from li_balk";
$maxresult=mysql_query($maxquery);
$max=mysql_fetch_array($maxresult);
$maxid=$max[0]+1;

echo "<form action=\"li_balk_new2.php\" method=\"POST\" target=\"\">
<table>
<tr>
<td width=\"250\">Start-Auftragsnummer:</td>
<td><input type=\"int\" name=\"startnummer\" value=\"$maxid\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Anzahl der Auftr&auml;ge:</td>
<td><input type=\"int\" name=\"anznumbers\" value=\"1\" size=\"2\" maxlength=\"2\"></td>
</tr>
<tr>
<td>Gemarkung:</td>
<td>
<select name=\"gemark_id\">";

 $query="SELECT * FROM gemarkung where gemark_id < '139999' ORDER BY gemarkung";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }

 echo "</select>
</td>

<tr>
<td>
Flur:
</td>
<td>
<input type=\"Text\" name=\"flur_id\" value=\"\" size=\"3\" maxlength=\"3\">
</td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"mitarb_id\">";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option value=\"$r2[mitarb_id]\"";
   if ($r2[mitarb_id] == $mitarb_id) echo " selected";
   echo">$r2[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>verworfen:</td>
<td><select name=\"worry\">";

 
   echo "<option value=\"0\" selected>nein</option>
         <option value=\"1\">ja</option>";
  
   echo "</select></td>
</tr>

<tr>
<td>Jahrgang:</td>
<td><input type=\"text\" name=\"year\" value=\"$year\" size=\"4\" maxlength=\"4\"></td>
</tr>
<tr>
<td>Datum:</td>
<td><input type=\"date\" name=\"datum\" value=\"$print_datum\" size=\"10\" maxlength=\"10\"></td>
<tr>
<td colspan=\"2\"><br><input type=\"Submit\" name=\"\" value=\"Pr&uuml;fen und Eintragen\"></td>
</tr>
</table>
</form>";

bottom();
?>