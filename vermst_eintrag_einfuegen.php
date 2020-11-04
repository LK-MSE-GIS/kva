<?php

include("connect.php");
include("function.php");

xhead_ant();
xmain_nav();
nav_vermst();

$vermst=$_POST["vermst"];
$contact=$_POST["contact"];
$strasse=$_POST["strasse"];
$plz=$_POST["plz"];
$ort=$_POST["ort"];
$email=$_POST["email"];
$telefon=$_POST["telefon"];
$fax=$_POST["fax"];
$liste=$_POST["liste"];
$wvp=$_POST["wvp"];

$query="INSERT INTO vermst (vermst,contact,strasse,plz,ort,email,telefon,fax,liste,wvp)
VALUES
('$vermst','$contact','$strasse','$plz','$ort','$email','$telefon','$fax','$liste','$wvp');";
mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

echo "<p align=center>";
echo "Der neue Eintrag wurde angelegt.";
echo "</b>";

nav_vermst();
bottom();
?>