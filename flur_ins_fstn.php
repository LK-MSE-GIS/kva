<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("alkgrund");


$gemarkung=$_POST["gemarkung"];
$flur=$_POST["flur"];
$zaehler=$_POST["zaehler"];
$nenner=$_POST["nenner"];
$comment=$_POST["comment"];
$id=$_POST["id"];

$query="UPDATE fstn
           SET nenner='$nenner',
               comment='$comment'
               WHERE gemarkung='$gemarkung' AND flur='$flur' AND zaehler='$zaehler';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


echo "<p align=center>";
?>
<img src="images\ok.jpg" alt="" border="0"><br><br>
<?php
echo "Neuer Nenner eingetragen.<br><br>";

echo "<a href=\"flur_show_fstn.php?id=$id\">[Weiter]</a><br><br>";
echo "</b>";

nav_ant("alkgrund");
bottom();
?>