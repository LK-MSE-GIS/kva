<?php

include("connect.php");
include("function.php");


head_ant();



$aktort_id=$_POST["aktort_id"];
$id=$_POST["id"];
$page=$_POST["page"];
$status=$_POST["status"];
$ueb_datum=$_POST["ueb_datum"];
$ueb_mit_id=$_POST["ueb_mit_id"];
$ueb_ja_nein=$_POST["ueb_ja_nein"];
$ueb_aen=$_POST["ueb_aen"];
$alk_datum=$_POST["alk_datum"];
$alk_mit_id=$_POST["alk_mit_id"];
$alk_ja_nein=$_POST["alk_ja_nein"];
$alb_datum=$_POST["alb_datum"];
$alb_mit_id=$_POST["alb_mit_id"];
$alb_ja_nein=$_POST["alb_ja_nein"];
$riss_ja_nein=$_POST["riss_ja_nein"];
$riss_1=$_POST["riss_1"];
$riss_2=$_POST["riss_2"];
$riss_3=$_POST["riss_3"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern_uebernahme.php?id=$id&page=$page&status=$status\">
</head>";

$query="UPDATE antrag_extra SET ueb_mit_id='$ueb_mit_id',ueb_ja_nein='$ueb_ja_nein',alk_mit_id='$alk_mit_id', alk_ja_nein='$alk_ja_nein',alb_mit_id='$alb_mit_id',alb_ja_nein='$alb_ja_nein' WHERE id='$id'";


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);

$query2="UPDATE antrag SET aktort_id='$aktort_id',ueb_datum='$ueb_datum',ueb_aen='$ueb_aen',alk_datum='$alk_datum',riss_ja_nein='$riss_ja_nein',riss_1='$riss_1',riss_2='$riss_2',riss_3='$riss_3',alb_datum='$alb_datum' WHERE id='$id'";

mysql_query($query2) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query2;

write_log("verm.log",$logeintrag);



bottom();
?>