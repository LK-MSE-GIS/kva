<head>
<meta http-equiv="refresh" content="0; URL=baustellen_list.php">
</head>
<?php

include("connect.php");
include("function.php");

$id=$_GET["id"];

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


  $query="update baustellen set baust_end='$currenttime' WHERE id=$id";
   mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


bottom();
?>