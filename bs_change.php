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



$query="SELECT * from fd_bs where oid='$id'";
$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);
$old_status=$r[status];

if ($r[status] != $status)
  {

   $query="UPDATE fd_bs
           SET status='$status' WHERE oid='$id'";

  $result = $dbqueryp($connectp,$query);

  }

if ($old_status == "keine Aktion") $list='0';
if ($old_status == "bei Vermessungsstelle") $list='1';
if ($old_status == "Eingangsprüfung") $list='2';
if ($old_status == "in ALK ohne NS und GL") $list='3';
if ($old_status == "in ALk übernommen vollständig") $list='4';



echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=bs_list.php?status=$list\">
</head>";

bottom();
?>