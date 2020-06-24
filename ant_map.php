<?php

include ("connect.php");
include ("function.php");


$rechts=$_GET["rechts"];
$hoch=$_GET["hoch"];
$range=$_GET["range"];
$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

head_ant();
nav_ant();
nav_aendern($id,$dbname,$page,$status);

$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);

$gemarkung_1=$r[gemark_id_1];
$flur_1=$r[flur_1];
while (strlen($flur_1) <3)
  {
    $flur_1='0'.$flur_1;
  }
$flur_id_1=$gemarkung_1."-".$flur_1;
$flurid_1=$gemarkung_1.$flur_1; 
   

if ($r[gemark_id_2] > 0)
 {
 $gemarkung_2 =$r[gemark_id_2];
 if ($r[flur_2] > 0)
  {
   $flur_2 =$r[flur_2];
   while (strlen($flur_2) <3)
  {
    $flur_2='0'.$flur_2;
  }
  $flur_id_2=$gemarkung_2."-".$flur_2;
  $flurid_2=$gemarkung_2.$flur_2;
  }
}

if ($r[gemark_id_3] > 0)
 {
 $gemarkung_3 =$r[gemark_id_3];
 if ($r[flur_3] > 0)
  {
   $flur_3 =$r[flur_3];
   while (strlen($flur_3) <3)
  {
    $flur_3='0'.$flur_3;
  }
  $flur_id_3=$gemarkung_3."-".$flur_3;
  $flurid_3=$gemarkung_3.$flur_3;
  }
 }


$aktenz=$r[number]."/".substr($r[year],2,2);



echo "<table border=\"0\">
<tr bgcolor=\"#EFA036\">
<td colspan=\"4\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> Karte&nbsp;&nbsp;$aktenz&nbsp;</td></tr>
<tr bgcolor=\"#EFA036\">
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
</tr><tr><td style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">";




echo "<iframe  scrolling=\"no\"  src=\"ol-karte.php?lon=$rechts&lat=$hoch\" width=\"800\" height=\"600\" frameborder=\"0\">";

?> 

