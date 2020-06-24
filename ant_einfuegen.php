<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();

$vermst_id=$_POST["vermst_id"];

$gemark_id_1=$_POST["gemark_id_1"];
$flur_1=$_POST["flur_1"];
$flst_1=$_POST["flst_1"];
$flst_1alt=$_POST["flst_1alt"];

$gemark_id_2=$_POST["gemark_id_2"];
$flur_2=$_POST["flur_2"];
$flst_2=$_POST["flst_2"];
$flst_2alt=$_POST["flst_2alt"];

$gemark_id_3=$_POST["gemark_id_3"];
$flur_3=$_POST["flur_3"];
$flst_3=$_POST["flst_3"];
$flst_3alt=$_POST["flst_3alt"];


$vermart_id=$_POST["vermart_id"];
$eing_datum=$_POST["eing_datum"];
$sv=$_POST["sv"];
$az=$_POST["az"];
$hurry=$_POST["hurry"];
$aktort_id=$_POST["aktort_id"];

$rechts=$_POST["rechts"];
$hoch=$_POST["hoch"];

if($vermst_id>0 AND $gemark_id_1>0 AND $vermart_id>0)
{
  $datum = getdate(time());
  $jahr=$datum[year];
  $keyquery="SELECT * FROM order_key WHERE id = '2'";
  $keyresult=mysql_query($keyquery,$db_link);
  $key_r=mysql_fetch_array($keyresult);

  if ($jahr==$key_r[time])
     {
      $number=$key_r[number]+1;
      $successor=$key_r[number]+1;
      $keyquery="update order_key set number=$successor WHERE id='2'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }
      else
      {
      $number=4000;
      $keyquery="update order_key set number=$number,time='$jahr' WHERE id='2'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }

$query="INSERT INTO antrag (lk,number,year,vermst_id,gemark_id_1,flur_1,flst_1,flst_1alt,gemark_id_2,flur_2,flst_2,flst_2alt,gemark_id_3,flur_3,flst_3,flst_3alt,vermart_id,eing_datum,sv,az,aktort_id,hurry,rechts,hoch)
VALUES
('Mu','$number','$jahr','$vermst_id','$gemark_id_1','$flur_1','$flst_1','$flst_1alt','$gemark_id_2','$flur_2','$flst_2','$flst_2alt','$gemark_id_3','$flur_3','$flst_3','$flst_3alt','$vermart_id','$eing_datum','$sv','$az','$aktort_id','$hurry','$rechts','$hoch');";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

echo "<p align=center>";
$query2="SELECT * FROM antrag WHERE year='$jahr' AND number='$number';";
$result2=mysql_query($query2,$db_link);
$r2=mysql_fetch_array($result2);

$query3="INSERT INTO antrag_extra (id) VALUES ('$r2[id]');";

mysql_query($query3) OR DIE ("Der Eintrag in antrag_extra schlug fehl...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);

echo "Der neue Eintrag wurde mit folgenden Grunddaten angelegt:";
echo "</b><br><br>


<table border=\"2\">
<tr>
 <td width=\"190\" bgcolor=\"#a0a0a0\">Antragsnummer: </td>
 <td><h2>$r2[number]/$r2[year] </h2></td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">eingetragen am: </td>
 <td>$r2[eing_datum]</td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Vermessungsstelle: </td>
 <td>";
     $query3="SELECT * FROM vermst WHERE vermst_id=$r2[vermst_id]";
     $result3=mysql_query($query3,$db_link);
     $r3=mysql_fetch_array($result3);
     echo"$r3[vermst]
 </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Vermessungsart: </td>
 <td>";
     $query5="SELECT * FROM vermart WHERE vermart_id=$r2[vermart_id]";
     $result5=mysql_query($query5,$db_link);
     $r5=mysql_fetch_array($result5);
     echo"$r5[vermart]
  </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Gemarkung: </td>
 <td>";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r2[gemark_id_1]";
     $result4=mysql_query($query4,$db_link);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
  </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Flur(en): </td>
 <td>$r2[flur_1] </td>
</tr>
<tr>
 <td bgcolor=\"#a0a0a0\">Flurstück(e): </td>
 <td>$r2[flst_1alt] </td>
</tr>
<tr>
 <td colspan=\"2\" align =\"center\"><a href=\"ant_aendern.php?id=$r2[id]\">Bearbeiten</a> </td>
</tr>
</table><br>";
}
else
{
echo "<h2>Der Eintrag wurde nicht angelegt!<br>Es fehlten wichtige Angaben..</h2><br>";
echo "&Uuml;berpr&uuml;fen Sie ob eine Vermessungsstelle, eine Gemarkung und eine Vermessungsart angegeben wurde. <br><br>";
echo "Vermessungsstelle:$vermst_id<br>
      Gemarkung:$gemark_id_1<br>
      Verm.-art:$vermart_id";
}
nav_ant();
bottom();
?>