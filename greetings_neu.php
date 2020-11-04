<?php
include ("connect.php");

$query="SELECT * FROM mitarbeiter WHERE logname LIKE '$logname'";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
echo " <div style=\"font-family:Arial; font-size: 8pt; font-style: italic; color: white\">
     Sie sind angemeldet als<br><b style=\"font-family:Arial; font-size: 10pt; font-style: italic\">",$r["name"],"<b></div>";

?>
