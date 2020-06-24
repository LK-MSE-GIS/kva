<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("bos");


$id=$_POST["id"];
$bos_exists=$_POST["bos_exists"];
$bos_alk=$_POST["bos_alk"];
$bos_mit_id=$_POST["bos_mit_id"];
$bos_comm=$_POST["bos_comm"];
$bos_nachsch=$_POST["bos_nachsch"];
$bos_alb=$_POST["bos_alb"];
$bos_nach_alb=$_POST["bos_nach_alb"];
$bos_nach_alk=$_POST["bos_nach_alk"];
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_bos.php?id=$id\">
</head>";

$query="UPDATE flur
           SET bos_exists='$bos_exists',
               bos_mit_id='$bos_mit_id',
               bos_comm='$bos_comm',
               bos_nachsch='$bos_nachsch',
               bos_nach_alk='$bos_nach_alk'
               WHERE ID='$id';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Flur mit der ID:".$id." Eintrag Bodenschaetzung geändert";

write_log("fluren.log",$logeintrag);



nav_flur("bos");
bottom();
?>