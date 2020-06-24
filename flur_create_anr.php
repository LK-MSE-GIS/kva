<?php

include("connect.php");

    $datum = getdate(time());
    $year=$datum[year];
    $month=$datum[mon];
    $day=$datum[mday];
    $hour=$datum[hours];
    $min=$datum[minutes];
    $sec=$datum[seconds];

    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($hour) == 1) $hour='0'.$hour;
    if (strlen($min) == 1) $min='0'.$min;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$year."-".$month."-".$day;
    $german_date=$day.".".$month.".".$year;



$id=$_GET["id"];

$gemark_id=$_GET["gemkg_id"];
$flur_id=$_GET["flur_id"];
$fall=$_GET["case"];


  $keyquery="SELECT * FROM order_key WHERE id = '2'";
  $keyresult=mysql_query($keyquery);
  $key_r=mysql_fetch_array($keyresult);

  if ($year==$key_r[time])
     {
      $number=$key_r[number]+1;
      $successor=$key_r[number]+1;
      $keyquery="update order_key set number=$successor WHERE id='2'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }
      else
      {
      $number=1;
      $keyquery="update order_key set number=$number,time='$year' WHERE id='2'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_alkis.php?id=$id\">
</head>";

if ($fall == 'nu')
 {
 $sv = "Feldvergleich Nutzungsarten";
 $feld="alkis_feldnutz_anr";
 }
if ($fall == 'flber')
 { 
 $sv = "Flächendifferenz - Neuberechnung";
 $feld="alkis_flber_anr";
 }
if ($fall == 'fldig')
 { 
 $sv = "Flächendifferenz - Neudigitalisierung";
 $feld="alkis_fldig_anr";
 }
if ($fall == 'mig')
 { 
 $sv = "ALKIS Vormigration";
 $feld="alkis_mig_anr";
 }

$query="INSERT INTO antrag (lk,number,year,eing_datum,vermst_id,gemark_id_1,flur_1,vermart_id,sv)
VALUES
('Mu','$number','$year','$print_datum','1','$gemark_id','$flur_id','12','$sv');";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$query2="SELECT * FROM antrag WHERE year='$year' AND number='$number';";
$result2=mysql_query($query2);
$r2=mysql_fetch_array($result2);

$query3="INSERT INTO antrag_extra (id,vorb_ja_nein,re_ja_nein) VALUES ('$r2[id]','2','2');";

mysql_query($query3) OR DIE ("Der Eintrag in antrag_extra schlug fehl...");




$query5="UPDATE flur set $feld='$r2[id]' WHERE id=$id;";
mysql_query($query5) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Antrag ".$r2[id]." angelegt";

write_log("verm.log",$logeintrag);



?>