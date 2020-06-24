<?php

include("connect.php");
include("function.php");


head_ant();
nav_ant();


$aktort_id=$_POST["aktort_id"];
$id=$_POST["id"];
$status=$_POST["status"];
$number=$_POST["number"];
$year=$_POST["year"];
$page=$_POST["page"];
$vorb_datum=$_POST["vorb_datum"];
$vorb_mit_id=$_POST["vorb_mit_id"];
$vorb_unterl=$_POST["vorb_unterl"];
$vorb_kassz=$_POST["vorb_kassz"];
$vorb_betrag=$_POST["vorb_betrag"];
$vorb_ja_nein=$_POST["vorb_ja_nein"];
$vorb_re_datum=$_POST["vorb_re_datum"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern_vorb.php?id=$id&page=$page&status=$status\">
</head>";


$query="UPDATE antrag_extra SET vorb_mit_id='$vorb_mit_id',vorb_unterl='$vorb_unterl',vorb_kassz='$vorb_kassz',vorb_ja_nein='$vorb_ja_nein',vorb_re_datum='$vorb_re_datum',vorb_betrag='$vorb_betrag' WHERE id='$id'";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);

$query2="UPDATE antrag SET aktort_id='$aktort_id',vorb_datum='$vorb_datum' WHERE id='$id'";

mysql_query($query2) OR DIE ("Der Eintrag2 konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query2;

write_log("verm.log",$logeintrag);


nav_ant();
bottom();
?>