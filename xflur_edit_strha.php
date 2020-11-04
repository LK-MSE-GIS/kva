<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();
head_flur();
nav_flur("strha");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
flur_kopf($id,$db_link);
navi_flur("alk_strha",$id);
abhaken($r["ID"],$db_link,"80",0);
 echo"</table>";

echo"
<form action=\"flur_ins_strha.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">";




 if ($r["geb"]=='1')
{

echo "<br>

<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#02A2EE\" colspan=\"2\">ALK - &Uuml;berarbeitung von Strassen/Hausnummern</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">&Uuml;berarbeitung durch das Amt</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"strha_amt\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">keine Aktion</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">kein Bestand</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">beim Amt</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==3)
    {
    echo " selected";
    }
    echo " value=\"3\">vom Amt zur&uuml;ck</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==4)
    {
    echo " selected";
    }
    echo " value=\"4\">BOV</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_amt"]==5)
    {
    echo " selected";
    }
    echo " value=\"5\">durch KVA erledigt</option>
   </select></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">&uuml;bergeben / erhalten am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"strha_amt_dat\" value=\"$r[strha_amt_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">&Uuml;bernahme in das ALB:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"strha_alb\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_alb"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_alb"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>

</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"strha_mitalb_id\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alb%'";
 $result5=mysqli_query($db_link,$query5);

 while($r5=mysqli_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5["mitarb_id"] == $r["strha_mitalb_id"])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">Datum der &Uuml;bernahme:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"strha_alb_dat\" value=\"$r[strha_alb_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">&Uuml;bernahme in die ALK:</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"strha_alk\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_alk"]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">nein</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r["strha_alk"]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">ja</option>
    </select></td>

</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"strha_mit_id\">";

 $query4="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%alk%'";
 $result4=mysqli_query($db_link,$query4);

 while($r4=mysqli_fetch_array($result4))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r4["mitarb_id"] == $r["strha_mit_id"])
   {
   echo " selected";
   }
   echo " value=\"$r4[mitarb_id]\">$r4[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#02A2EE\">Datum der &Uuml;bernahme:</td>
<td><input style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"strha_alk_dat\" value=\"$r[strha_alk_dat]\" size=\"10\" ></td>
</tr>
</table>


<br>
<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
}
else
{
  echo "<div align=\"center\">
        <img src=\"images/no_house.jpg\"  border=\"0\" width=\"240\">
  </div>";
}
echo "<br><br>";


nav_flur("strha");
bottom();
?>