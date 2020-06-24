
<?php

include("connect.php");
include("function.php");

$gemark_id=$_GET["gemark_id"];
$id=$_GET["id"];
$rissnummer=$_GET["riss"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=nachweise.php?id=$id\">
</head>";



$query="update riss_nummer set last_riss=$rissnummer where gemark_id='$gemark_id';";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


bottom();
?>