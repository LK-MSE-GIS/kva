
<?php

include("connect.php");
include("function.php");

$gemark_id=$_GET["gemark_id"];
$id=$_GET["id"];
$riss_id=$_GET["riss_id"];
$status=$_GET["status"];
$page=$_GET["page"];
$alt=$_GET["alt"];


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_nachweise.php?id=$id&page=$page&status=$status&alt=$alt\">
</head>";



  $query="DELETE FROM risse2antrag WHERE antrag_id = '$id' AND gemark_id = '$gemark_id' AND riss_id='$riss_id';";
 
  mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


bottom();
?>