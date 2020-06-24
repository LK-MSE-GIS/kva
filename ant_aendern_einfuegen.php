<?php

include("connect.php");
include("function.php");

head_ant();

$id=$_POST["id"];
$status=$_POST["status"];
$aktenz=$_POST["aktenz"];
$vermst_id=$_POST["vermst_id"];
$vermart_id=$_POST["vermart_id"];

$gemark_id_1=$_POST["gemark_id_1"];
$flur_1=$_POST["flur_1"];
$flst_1alt=$_POST["flst_1alt"];
$flst_1=$_POST["flst_1"];

$gemark_id_2=$_POST["gemark_id_2"];
$flur_2=$_POST["flur_2"];
$flst_2alt=$_POST["flst_2alt"];
$flst_2=$_POST["flst_2"];

$gemark_id_3=$_POST["gemark_id_3"];
$flur_3=$_POST["flur_3"];
$flst_3alt=$_POST["flst_3alt"];
$flst_3=$_POST["flst_3"];

$page=$_POST["page"];
$sv=$_POST["sv"];
$az=$_POST["az"];
$aktort_id=$_POST["aktort_id"];
$eing_datum=$_POST["eing_datum"];
$hurry=$_POST["hurry"];

$rechts=$_POST["rechts"];
$hoch=$_POST["hoch"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern.php?id=$id&page=$page&status=$status\">
</head>";
$query="UPDATE antrag SET vermst_id='$vermst_id',gemark_id_1='$gemark_id_1',flur_1='$flur_1',flst_1alt='$flst_1alt',flst_1='$flst_1',gemark_id_2='$gemark_id_2',flur_2='$flur_2',flst_2alt='$flst_2alt',flst_2='$flst_2',gemark_id_3='$gemark_id_3',flur_3='$flur_3',flst_3alt='$flst_3alt',flst_3='$flst_3',vermart_id='$vermart_id',sv='$sv',az='$az',hoch='$hoch',rechts='$rechts',hurry='$hurry',eing_datum='$eing_datum',aktort_id='$aktort_id' WHERE id='$id';";


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);



bottom();
?>