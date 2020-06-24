<?php

include("connect.php");
include("function.php");

head_vermst();
nav_vermst();

$vermst=$_POST["vermst"];
$contact=$_POST["contact"];
$strasse=$_POST["strasse"];
$plz=$_POST["plz"];
$ort=$_POST["ort"];
$email=$_POST["email"];
$telefon=$_POST["telefon"];
$fax=$_POST["fax"];
$vermst_id=$_POST["vermst_id"];
$liste=$_POST["liste"];
$wvp=$_POST["wvp"];
$query="UPDATE vermst
           SET vermst='$vermst',
               contact='$contact',
               strasse='$strasse',
               ort='$ort',
               plz='$plz',
               email='$email',
               telefon='$telefon',
               wvp='$wvp',
               liste='$liste',
               fax='$fax'
               WHERE vermst_id='$vermst_id';";


mysql_query($query) OR DIE ("Die &Auml;nderung konnte nicht durchgef&uuml;hrt werden...");


echo "<p align=center>";
echo "Der Eintrag f&uuml;r die Vermessungsstelle<br><br>

",$vermst," <br><br>

wurde ge&auml;ndert.";
echo "</b><br><br>

<a href=\"vermst_aendern.php?vermst_id=$vermst_id\">zurück zur Vermessungsstelle</a><br>
<br>
";

nav_vermst();
bottom();
?>