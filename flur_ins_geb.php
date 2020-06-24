<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("geb");


$id=$_POST["id"];
$altgeb_status=$_POST["altgeb_status"];
$altgeb_db_dat=$_POST["altgeb_db_dat"];
$altgeb_mit_id=$_POST["altgeb_mit_id"];
$altgeb_kartart=$_POST["altgeb_kartart"];
$altgeb_vermst=$_POST["altgeb_vermst"];
$geb_mstab_dat=$_POST["geb_mstab_dat"];
$geb_auf_dat=$_POST["geb_auf_dat"];
$geb_abschl_dat=$_POST["geb_abschl_dat"];


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_geb.php?id=$id\">
</head>";

$query="UPDATE flur
           SET altgeb_status='$altgeb_status',
               altgeb_db_dat='$altgeb_db_dat',
               altgeb_mit_id='$altgeb_mit_id',
               altgeb_kartart='$altgeb_kartart',
               altgeb_vermst='$altgeb_vermst',
               geb_mstab_dat='$geb_mstab_dat',
               geb_auf_dat='$geb_auf_dat',
               geb_abschl_dat='$geb_abschl_dat'
               WHERE ID='$id';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");




nav_ant("geb");
bottom();
?>