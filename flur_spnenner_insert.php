<?php

include("connect.php");
include("function.php");


$id=$_POST["id"];
$zaehler=$_POST["zaehler"];
$nenner=$_POST["nenner"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_show_fstn.php?id=$id\">
</head>";

$query="INSERT INTO nenner (zaehler,nenner) VALUES ('$zaehler','$nenner');";
           


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

?>