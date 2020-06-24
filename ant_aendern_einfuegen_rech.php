<?php

include("connect.php");
include("function.php");


head_ant();



$aktort_id=$_POST["aktort_id"];
$id=$_POST["id"];
$page=$_POST["page"];
$status=$_POST["status"];
$re_rech1=$_POST["re_rech1"];
$re_betrag1=$_POST["re_betrag1"];
$re_kz1=$_POST["re_kz1"];
$re_unterl1=$_POST["re_unterl1"];
$re_empf1=$_POST["re_empf1"];
$re_rech2=$_POST["re_rech2"];
$re_betrag2=$_POST["re_betrag2"];
$re_kz2=$_POST["re_kz2"];
$re_unterl2=$_POST["re_unterl2"];
$re_empf2=$_POST["re_empf2"];
$re_rech3=$_POST["re_rech3"];
$re_betrag3=$_POST["re_betrag3"];
$re_kz3=$_POST["re_kz3"];
$re_unterl3=$_POST["re_unterl3"];
$re_empf3=$_POST["re_empf3"];
$re_rech4=$_POST["re_rech4"];
$re_betrag4=$_POST["re_betrag4"];
$re_kz4=$_POST["re_kz4"];
$re_unterl4=$_POST["re_unterl4"];
$re_empf4=$_POST["re_empf4"];
$re_rech5=$_POST["re_rech5"];
$re_betrag5=$_POST["re_betrag5"];
$re_kz5=$_POST["re_kz5"];
$re_unterl5=$_POST["re_unterl5"];
$re_empf5=$_POST["re_empf5"];
$re_mit_id=$_POST["re_mit_id"];
$re_ja_nein=$_POST["re_ja_nein"];


$nachfolger=$id+1;
$vorgaenger=$id-1;

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern_rech.php?id=$id&page=$page&status=$status\">
</head>";

$query="UPDATE antrag_extra SET re_mit_id='$re_mit_id',re_ja_nein='$re_ja_nein',re_rech1='$re_rech1',re_betrag1='$re_betrag1',re_kz1='$re_kz1',re_empf1='$re_empf1',re_unterl1='$re_unterl1',re_rech2='$re_rech2',re_betrag2='$re_betrag2',re_kz2='$re_kz2',re_empf2='$re_empf2',re_unterl2='$re_unterl2',re_rech3='$re_rech3',re_betrag3='$re_betrag3',re_kz3='$re_kz3',re_empf3='$re_empf3',re_unterl3='$re_unterl3',re_rech4='$re_rech4',re_betrag4='$re_betrag4',re_kz4='$re_kz4',re_empf4='$re_empf4',re_unterl4='$re_unterl4',re_rech5='$re_rech5',re_betrag5='$re_betrag5',re_kz5='$re_kz5',re_empf5='$re_empf5',re_unterl5='$re_unterl5' WHERE id='$id'";

echo $query;
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query;

write_log("verm.log",$logeintrag);

$query2 ="UPDATE antrag set aktort_id='$aktort_id' WHERE id ='$id'";
mysql_query($query2) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." : ".$query2;

write_log("verm.log",$logeintrag);


bottom();
?>