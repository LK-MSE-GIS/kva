<?php
include ("connect.php");
include ("li_function.php");

head_li_a();

$number=$_POST["number"];
$antrag=$_POST["antrag"];
$year=$_POST["year"];
$flst1=$_POST["flst1"];
$flst2=$_POST["flst2"];
$flst3=$_POST["flst3"];
$flst4=$_POST["flst4"];
$vermart_id=$_POST["vermart_id"];
$vorb_date=$_POST["vorb_date"];
$vorb_mit_id=$_POST["vorb_mit_id"];
$take_date=$_POST["take_date"];
$take_mit_id=$_POST["take_mit_id"];


$error=0;
if (($number <= '19999') AND ($number > '0'))
  {
  $query="SELECT number from li_a where number=".$number." and year =".$year.";";
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
   echo "<br>Die ALB-Nummer muss im Bereich von 1 bis 19999 liegen!<br>";
 }

if ($vermart_id == '0')
   {
    $error=1;
    echo "<br>Sie haben keine Vermessungsart ausgew&auml;hlt.";
    }
if ($vorb_mit_id == '0')
   {
    $error=1;
    echo "<br>Sie haben keinen Vorbereitungs-Mitarbeiter ausgew&auml;hlt.";
    }
if ($vorb_date == '')
   {
    $error=1;
    echo "<br>Sie haben kein Vorbereitungs-Datum eingegeben";
    }
if ($flst1 == '')
   {
    $error=1;
    echo "<br>Sie m&uuml;ssen mindestens ein Flurst&uuml;ck eingeben.";
    }


 if ($error ==0)
 {
     $query="INSERT INTO li_a (year,number,antrag,flst1,flst2,flst3,flst4,vermart_id, vorb_date, vorb_mit_id, take_date, take_mit_id)
VALUES
('$year','$number','$antrag','$flst1','$flst2','$flst3','$flst4','$vermart_id','$vorb_date','$vorb_mit_id','$take_date','$take_mit_id');";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

 echo "<br><br>Die Auftragsnummer ",$number," wurde eingetragen.";
 }
 else
 {
echo "<br>Bitte Eingabe pr&uuml;fen und erneut versuchen!<br><br>Die letzten 3 Eintr&auml;ge:";

$countquery="SELECT id FROM li_a; ";
$recanz=li_count($dbname,$countquery);
$offset=$recanz-3;
if ($recanz < 3) $offset=0;
$query="SELECT * from li_a  ORDER BY \"year\",\"number\" limit $offset,3;";
$result=mysql_query($query);
echo "<table>
<tr>
<td width=\"50\">Jahr</td>
<td width=\"80\">ALB-N</td>
<td width=\"112\">Antrag</td>
<td width=\"240\">Flurst&uuml;ck</td>
<td width=\"240\">Verm.-art</td>
<td width=\"120\">V-Datum</td>
<td width=\"120\">E-Datum</td>
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
   <td valign=\"top\">$r[antrag]</td>
   <td valign=\"top\">$r[flst1]";
   if ($r[flst2] != "") echo "<br>",$r[flst2];
   if ($r[flst3] != "") echo "<br>",$r[flst3];
   if ($r[flst4] != "") echo "<br>",$r[flst4];
   echo "</td>
   <td valign=\"top\">";
   $query1="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result1=mysql_query($query1);
     $r1=mysql_fetch_array($result1);
     echo"$r1[vermart]</td>
    <td valign=\"top\">$r[vorb_date]<br><small>";
   $query2="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[vorb_mit_id]";
     $result2=mysql_query($query2);
     $r2=mysql_fetch_array($result2);
     echo"$r2[name]</small>
   </td>
   <td valign=\"top\">$r[take_date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[take_mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small>
   </td>
   </tr>";
  }
 echo "</table>";

echo "<form action=\"li_a_new2.php\" method=\"POST\" target=\"\">
<table>
<tr>
<td width=\"250\">Auftragsnummer:</td>
<td><input type=\"int\" name=\"number\" value=\"$number\" size=\"5\" maxlength=\"5\"></td>
</tr>
<tr>
<td>Antragsnummer:</td>
<td><input type=\"int\" name=\"antrag\" value=\"$antrag\" size=\"7\" maxlength=\"7\"></td>
</tr>
<tr>
<td>Verm.art:</td>
<td>
<select name=\"vermart_id\">";

 $query="SELECT * FROM vermart ORDER BY vermart";
 $result=mysql_query($query);
 while($r=mysql_fetch_array($result))
   {
   echo "<option ";
   if ($r[vermart_id] == $vermart_id) echo "selected ";
   echo "value=\"$r[vermart_id]\">$r[vermart]</option>\n";
   }
 echo "</select>
</td>
<tr>
<td valign=\"top\">
Flurst&uuml;ck(e)
</td>
<td>
<input type=\"Text\" name=\"flst1\" value=\"$flst1\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst2\" value=\"$flst2\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst3\" value=\"$flst3\" size=\"18\" maxlength=\"18\"><br>
<input type=\"Text\" name=\"flst4\" value=\"$flst4\" size=\"18\" maxlength=\"18\">
</td>
</tr>
<tr>
<td>Vorb.-Datum:</td>
<td><input type=\"date\" name=\"vorb_date\" value=\"$vorb_date\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"vorb_mit_id\">";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option ";
   if ($r2[mitarb_id] == $vorb_mit_id) echo "selected ";
   echo "value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "</select></td>
</tr>
<tr>
<td>Erf.-Datum:</td>
<td><input type=\"date\" name=\"take_date\" value=\"$take_date\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"take_mit_id\">";

 $query3="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result3=mysql_query($query3);

 while($r3=mysql_fetch_array($result3))
   {
   echo "<option ";
   if ($r3[mitarb_id] == $take_mit_id) echo "selected ";
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