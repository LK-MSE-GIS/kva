<head>
</head>
<body bgcolor="#FF0000" text="#000000">
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
?>

<div align="center" style="font-family:Arial; font-size: 14pt; font-weight: bold">
<h2>M&ouml;chten Sie diese Baustelle wirklich löschen ?</h2>
<br><br>
<?php
echo "<a href=\"baustelle_abschl.php?id=$id\">Ja</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"baustellen_list.php\">Nein</a>";
?>
</div>
</body>