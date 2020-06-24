<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("alkgrund");


$id=$_POST["id"];
$bvvg=$_POST["bvvg"];
$off_datum=$_POST["off_datum"];
$alk_projekt_dat=$_POST["alk_projekt_dat"];
$db_datum=$_POST["db_datum"];
$fehlerf_dat=$_POST["fehlerf_dat"];
$bov=$_POST["bov"];
$bov_teilw=$_POST["bov_teilw"];
$geb=$_POST["geb"];
$siedlmes=$_POST["siedlmes"];
$barrier=$_POST["barrier"];
$vertrag=$_POST["vertrag"];
$vertrag_id=$_POST["vertrag_id"];
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_alkgrund.php?id=$id\">
</head>";


$query="UPDATE flur
           SET bvvg='$bvvg',
               off_datum='$off_datum',
               alk_projekt_dat='$alk_projekt_dat',
               db_datum='$db_datum',
               bov='$bov',
               bov_teilw='$bov_teilw',
               geb='$geb',
               siedlmes='$siedlmes',
               vertrag='$vertrag',
               vertrag_id='$vertrag_id',
               barrier='$barrier',
               fehlerf_dat='$fehlerf_dat'
               WHERE ID='$id';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Flur mit der ID:".$id." Grunddaten geaendert";

write_log("fluren.log",$logeintrag);



nav_ant("alkgrund");
bottom();
?>