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



$id=$_POST["id"];
$alkis_feld_dat=$_POST["alkis_feld_dat"];
$alkis_feld_mitid=$_POST["alkis_feld_mitid"];
$alkis_feld_stat=$_POST["alkis_feld_stat"];
$alkis_felddb_mitid=$_POST["alkis_felddb_mitid"];
$alkis_felddb_dat=$_POST["alkis_felddb_dat"];
$alkis_albalk_dat=$_POST["alkis_albalk_dat"];
$alkis_albalk_mitid=$_POST["alkis_albalk_mitid"];
$alkis_albalk_stat=$_POST["alkis_albalk_stat"];
$alkis_st2_date=$_POST["alkis_st2_date"];
$alkis_knick_date=$_POST["alkis_knick_date"];
$alkis_st3_date=$_POST["alkis_st3_date"];
$alkis_st2_mitid=$_POST["alkis_st2_mitid"];
$alkis_knick_mitid=$_POST["alkis_knick_mitid"];
$alkis_st3_mitid=$_POST["alkis_st3_mitid"];
$alkis_feldorder_dat=$_POST["alkis_feldorder_dat"];
$alkis_feldok_dat=$_POST["alkis_feldok_dat"];
$alkis_feldnutz_mitid=$_POST["alkis_feldnutz_mitid"];
$alkis_feldnutz_stat=$_POST["alkis_feldnutz_stat"];
$alkis_florder_dat=$_POST["alkis_florder_dat"];
$alkis_flber_dat=$_POST["alkis_flber_dat"];
$alkis_flber_mitid=$_POST["alkis_flber_mitid"];
$alkis_fldig_dat=$_POST["alkis_fldig_dat"];
$alkis_fldig_mitid=$_POST["alkis_fldig_mitid"];
$alkis_fl_stat=$_POST["alkis_fl_stat"];
$nutz_alt=$_POST["nutz_alt"];
$fl_alt=$_POST["fl_alt"];
$dat_alt=$_POST["dat_alt"];
$mitid_alt=$_POST["mitid_alt"];
$alkis_akt1_dat=$_POST["alkis_akt1_dat"];
$alkis_akt1_mitid=$_POST["alkis_akt1_mitid"];
$alkis_restf=$_POST["alkis_restf"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_alkis.php?id=$id\">
</head>";


$query="UPDATE flur
           SET alkis_feld_dat='$alkis_feld_dat',
               alkis_feld_mitid='$alkis_feld_mitid',
               alkis_felddb_dat='$alkis_felddb_dat',
               alkis_felddb_mitid='$alkis_felddb_mitid',
               alkis_feld_stat='$alkis_feld_stat',
               alkis_albalk_mitid='$alkis_albalk_mitid',
               alkis_albalk_dat='$alkis_albalk_dat',
               alkis_st2_date='$alkis_st2_date',
               alkis_st3_date='$alkis_st3_date',
			   alkis_knick_date='$alkis_knick_date',
               alkis_knick_mitid='$alkis_knick_mitid',
               alkis_st2_mitid='$alkis_st2_mitid',
               alkis_feldorder_dat='$alkis_feldorder_dat',
               alkis_feldok_dat='$alkis_feldok_dat',
               alkis_feldnutz_mitid='$alkis_feldnutz_mitid',
               alkis_feldnutz_stat='$alkis_feldnutz_stat',
               alkis_florder_dat='$alkis_florder_dat',
               alkis_flber_dat='$alkis_flber_dat',
               alkis_flber_mitid='$alkis_flber_mitid',
               alkis_fldig_dat='$alkis_fldig_dat',
               alkis_fldig_mitid='$alkis_fldig_mitid',
               alkis_akt1_dat='$alkis_akt1_dat',
               alkis_akt1_mitid='$alkis_akt1_mitid',
               alkis_fl_stat='$alkis_fl_stat',
               alkis_restf='$alkis_restf',
               alkis_st3_mitid='$alkis_st3_mitid',
               alkis_albalk_stat='$alkis_albalk_stat'
               WHERE ID='$id';";



mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");




?>