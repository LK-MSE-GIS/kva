<?php

include("connect.php");
include("function.php");





$id=$_POST["id"];
$strha_amt=$_POST["strha_amt"];
$strha_amt_dat=$_POST["strha_amt_dat"];
$strha_alk=$_POST["strha_alk"];
$strha_mit_id=$_POST["strha_mit_id"];
$strha_alk_dat=$_POST["strha_alk_dat"];
$strha_alb=$_POST["strha_alb"];
$strha_mitalb_id=$_POST["strha_mitalb_id"];
$strha_alb_dat=$_POST["strha_alb_dat"];
$nachfolger=$id+1;
$vorgaenger=$id-1;

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_strha.php?id=$id\">
</head>";

$query="UPDATE flur
           SET strha_amt='$strha_amt',
               strha_amt_dat='$strha_amt_dat',
               strha_alk='$strha_alk',
               strha_mit_id='$strha_mit_id',
               strha_alk_dat='$strha_alk_dat',
               strha_alb='$strha_alb',
               strha_mitalb_id='$strha_mitalb_id',
               strha_alb_dat='$strha_alb_dat'
               WHERE ID='$id';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Flur mit der ID:".$id." Eintrag Strassen/Hausnummern geaendert";

write_log("fluren.log",$logeintrag);


bottom();
?>