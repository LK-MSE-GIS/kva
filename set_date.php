
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
    $akt_datum=$year."-".$month."-".$day;


$id=$_GET["id"];
$table=$_GET["table"];
$script=$_GET["script"];
$column=$_GET["column"];
$page=$_GET["page"];
$status=$_GET["status"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=$script?id=$id&page=$page&status=$status\">
</head>";



$query="update $table set $column='$akt_datum' where id='$id';";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

if ($column == "abgl_date")
   {
    $query="update antrag set abgl_mitid='$mitarb_id' where id='$id';";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

    }

bottom();
?>