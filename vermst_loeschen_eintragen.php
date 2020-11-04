<?php

include("connect.php");
include("function.php");

head_vermst();
nav_vermst();


$vermst_id=$_GET["vermst_id"];

$query="DELETE FROM vermst WHERE vermst_id='$vermst_id';";

echo $query,"<br>";

mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht gel&ouml;scht werden...");


echo "<p align=center>";
echo "Der Satz mit der ID:",$vermst_id," wurde geköscht.";
echo "</b>";

nav_vermst();
bottom();
?>