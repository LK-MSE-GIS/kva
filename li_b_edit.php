<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];
$error=$_GET["error"];

head_li_b();
echo "<div align=\"center\"><h3>Datensatz bearbeiten</h3></div>";
$query="SELECT * from li_b where id='$id';";
$result=mysql_query($query);

$r=mysql_fetch_array($result);

if ($error != 0)
  {
   echo "Es fehlen wichtige Eingaben...<br>";
  }

echo "<form action=\"li_b_editins.php\" method=\"POST\" target=\"\">
<input type=\"hidden\" name=\"id\" value=\"$id\" >
<input type=\"hidden\" name=\"number\" value=\"$r[number]\" >
<input type=\"hidden\" name=\"year\" value=\"$r[year]\" >
<table>
<tr>
<td width=\"250\">ALB-Nummer:</td>
<td>$r[number]</td>
</tr>
<tr>
<td>FMA.:</td>
<td><input type=\"int\" name=\"fma\" value=\"$r[fma]\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Flurst&uuml;ck(e):</td>
<td><input type=\"int\" name=\"flst\" value=\"$r[flst]\" size=\"30\" maxlength=\"30\"></td>
</tr>
<tr>
<td>FA/Bem.:</td>
<td><input type=\"int\" name=\"fa_bem\" value=\"$r[fa_bem]\" size=\"30\" maxlength=\"30\"></td>
</tr>
<tr>
<td>Datum:</td>";
if ($r[date] == '0000-00-00')
 {
  $vorgabe=$print_datum;
 }
 else
 {
  $vorgabe=$r[date];
 }

echo "<td><input type=\"date\" name=\"date\" value=\"$vorgabe\" size=\"10\" maxlength=\"10\"></td>
</tr>
<tr>
<td>Mitarbeiter:</td>
<td><select name=\"mit_id\">";
 if ($r[mit_id] =='0')
    {
     $vorg_mit_id=$mitarb_id;
    }
    else
    {
     $vorg_mit_id=$r[mit_id];
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