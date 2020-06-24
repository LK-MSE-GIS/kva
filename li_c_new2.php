<?php
include ("connect.php");
include ("li_function.php");

head_li_c();

$number=$_POST["number"];
$bem=$_POST["bem"];
$year=$_POST["year"];
$grubu=$_POST["grubu"];
$fa_bem=$_POST["fa_bem"];
$date=$_POST["date"];
$mit_id=$_POST["mit_id"];


$error=0;
if (($number <= '49999') AND ($number > '19999'))
  {
  $query="SELECT number from li_c where number=".$number." and year =".$year.";";
  $result=mysql_query($query);
  if ($r=mysql_fetch_array($result))
     {
     $error=1;
     echo "<br>Auftragsnummer: ",$number," schon vergeben.";
     }

  }
 else
 {
   $error=1;
   echo "<br>Die ALB-Nummer muss im Bereich von 20000 bis 49999 liegen!<br>";
 }

if ($grubu == '')
   {
    $error=1;
    echo "<br>Sie haben keine Grundbuchnummer ausgew&auml;hlt.";
    }
if ($mit_id == '0')
   {
    $error=1;
    echo "<br>Sie haben keinen Mitarbeiter ausgew&auml;hlt.";
    }
if ($date == '')
   {
    $error=1;
    echo "<br>Sie haben kein Datum eingegeben";
    }



 if ($error ==0)
 {
     $query="INSERT INTO li_c (year,number,bem,grubu,fa_bem,date,mit_id)
VALUES
('$year','$number','$bem','$grubu','$fa_bem','$date','$mit_id');";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

 echo "<br><br>Die Auftragsnummer ",$number," wurde eingetragen.";
 }
 else
 {
echo "<br>Bitte Eingabe pr&uuml;fen und erneut versuchen!<br><br>Die letzten 3 Eintr&auml;ge:";

$countquery="SELECT id FROM li_c; ";
$recanz=li_count($dbname,$countquery);
$offset=$recanz-3;
if ($recanz < 3) $offset=0;
$query="SELECT * from li_c  ORDER BY \"year\",\"number\" limit $offset,3;";
$result=mysql_query($query);
echo "<table>
<tr>
<td width=\"50\">Jahr</td>
<td width=\"80\">ALB-N</td>
<td width=\"112\">Bem.</td>
<td width=\"240\">Grundbuch</td>
<td width=\"240\">FA/Bem.</td>
<td width=\"120\">Datum</td>
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
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td valign=\"top\">$r[year]</td>
   <td valign=\"top\">$r[number]</td>
   <td valign=\"top\">$r[bem]</td>
   <td valign=\"top\">$r[grubu]</td>
   <td valign=\"top\">$r[fa_bem]</td>
   <td valign=\"top\">$r[date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small></td>";
     echo "</tr>";
  }
 echo "</table>";

echo "<form action=\"li_c_new2.php\" method=\"POST\" target=\"\">
<table>
<tr>
<td width=\"250\">ALB-Nummer:</td>
<td><input type=\"int\" name=\"number\" value=\"$number\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Bemerkung:</td>
<td><input type=\"int\" name=\"bem\" value=\"$bem\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td valign=\"top\">
Grundbuch
</td>
<td>
<input type=\"Text\" name=\"grubu\" value=\"$grubu\" size=\"10\" maxlength=\"10\">
</td>
</tr>
<tr>
<td>FA/Bem.:</td>
<td><input type=\"int\" name=\"fa_bem\" value=\"$fa_bem\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Datum:</td>
<td><input type=\"date\" name=\"date\" value=\"$date\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"mit_id\">";

 $query3="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result3=mysql_query($query3);

 while($r3=mysql_fetch_array($result3))
   {
   echo "<option ";
   if ($r3[mitarb_id] == $mit_id) echo "selected ";
   echo "value=\"$r3[mitarb_id]\">$r3[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>Jahrgang:</td>
<td><input type=\"date\" name=\"year\" value=\"$year\" size=\"4\" maxlength=\"4\"></td>
</tr>
<tr>
<td colspan=\"2\"><br><input type=\"Submit\" name=\"\" value=\"Pr&uuml;fen und Eintragen\"></td>
</tr>
</table>
</form>";
 }

bottom();
?>