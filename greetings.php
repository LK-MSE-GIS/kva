<?php
include ("connect.php");

$query="SELECT * FROM mitarbeiter WHERE logname LIKE '$logname'";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
echo "<hr> <div style=\"font-family:Arial; font-size: 8pt; font-style: italic\">
     Sie sind angemeldet als<br>$r[name]<hr></div>";

?>
