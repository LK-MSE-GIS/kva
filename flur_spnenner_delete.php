<?php

include("connect.php");
include("function.php");


$id=$_GET["id"];
$zaehler=$_GET["zaehler"];


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_show_fstn.php?id=$id\">
</head>";

$query="DELETE FROM nenner WHERE zaehler='$zaehler';";
           


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

?>