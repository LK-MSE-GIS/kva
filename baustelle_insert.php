<head>
<meta http-equiv="refresh" content="0; URL=baustelle_new.php">
</head>
<?php

include("connect.php");
include("function.php");

$gem_id=$_POST["gem_id"];
$flur=$_POST["flur"];
$mit_id=$_POST["mit_id"];
$baust_art=$_POST["baust_art"];


$datum = getdate(time());
$year=$datum[year];
$month=$datum[mon];
$day=$datum[mday];
$hour=$datum[hours];
$minute=$datum[minutes];
$second=$datum[seconds];
if (strlen($month) == 1) $month='0'.$month;
if (strlen($day) == 1) $day='0'.$day;
if (strlen($hour) == 1) $hour='0'.$hour;
if (strlen($minute) == 1) $minute='0'.$minute;
if (strlen($second) == 1) $second='0'.$second;
$currenttime=$year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second;

if (($mit_id > 0) OR ($gem_id > 0))
{
  $query="INSERT INTO baustellen (mitarb_id,baust_start,baust_end,gem_id,baust_art,flur)
  VALUES
  ('$mit_id','$currenttime','nein','$gem_id','$baust_art','$flur');";
   mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
}

bottom();
?>