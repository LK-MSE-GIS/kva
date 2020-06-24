<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$gemarkung=$_GET["gemarkung"];
$flur=$_GET["flur"];
$zaehler=$_GET["zaehler"];
$id=$_GET["id"];

$query="DELETE FROM fstn
               WHERE gemarkung='$gemarkung' AND flur='$flur' AND zaehler='$zaehler';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
echo"<br><br>Der Eintrag wurde gelöscht...<br><br><a href=\"flur_show_fstn.php?id=$id\">[Weiter]</a><br><br>";

nav_flur("alkgrund");
bottom();
?>