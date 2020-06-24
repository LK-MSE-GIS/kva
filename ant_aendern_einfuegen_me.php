<?php

include("connect.php");
include("function.php");


head_ant();



$aktort_id=$_POST["aktort_id"];
$id=$_POST["id"];
$page=$_POST["page"];
$status=$_POST["status"];
$me_datum=$_POST["me_datum"];
$me_mit_id=$_POST["me_mit_id"];
$me_fehlend=$_POST["me_fehlend"];
$me_comment=$_POST["me_comment"];
$me_ja_nein=$_POST["me_ja_nein"];


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern_me.php?id=$id&page=$page&status=$status\">
</head>";

$query="UPDATE antrag_extra SET me_mit_id='$me_mit_id',me_fehlend='$me_fehlend',me_comment='$me_comment',me_ja_nein='$me_ja_nein' WHERE id='$id'";


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);



$query2 ="UPDATE antrag set me_datum='$me_datum',aktort_id='$aktort_id' WHERE id ='$id'";
mysql_query($query2) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query2;

write_log("verm.log",$logeintrag);



bottom();
?>