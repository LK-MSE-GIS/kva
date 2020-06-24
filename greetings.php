<?php
include ("connect.php");

$query="SELECT * FROM mitarbeiter WHERE logname LIKE '$logname'";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
echo "<hr> <div style=\"font-family:Arial; font-size: 8pt; font-style: italic\">
     Sie sind angemeldet als<br>",$r["name"],"<hr></div>";

?>
