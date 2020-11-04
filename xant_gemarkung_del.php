<?php

include("connect.php");
include("function.php");

$id=$_POST["id"];
$gemarkung_id=$_POST["gemarkung_id"];
$flur=$_POST["flur"];
$flst_alt=$_POST["flst_alt"];
$flst_neu=$_POST["flst_neu"];

$ido=$_GET["ido"];
$page=$_GET["page"];
$status=$_GET["status"];




if ($page >0)  
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ido&page=$page&status=$status\">
</head>";
 else
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ido&page=$page&status=$status\">
</head>";

$query="DELETE FROM `fluren2antrag` WHERE id = $id";
     mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht geändert werden...");
?>