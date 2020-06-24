<?php

include("connect.php");
include("connect_pgsql.php");

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




$id=$_POST["id"];
$status=$_POST["status"];


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=wv_list_$status.php\">
</head>";

$query="SELECT * from fd_wv where oid='$id'";
$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);

if ($r[status] != $status)
  {

   $query="UPDATE fd_wv
           SET status='$status',
               abgabe='$print_datum'
               WHERE oid='$id'";

  $result = $dbqueryp($connectp,$query);

  }


bottom();
?>