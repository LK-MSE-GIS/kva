<?php

include("connect.php");
include("function.php");

$ida=$_POST["ida"];
$vermst_id=$_POST["vermst_id"];
$az=$_POST["az"];
$vermart_id=$_POST["vermart_id"];
$ueb_datum=$_POST["ueb_datum"];
$ueb_aen=$_POST["ueb_aen"];

$page=$_GET["page"];
$status=$_GET["status"];


if ($page >0)  
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ida&page=$page&status=$status\">
</head>";
 else
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ida&page=$page&status=$status\">
</head>";

$query="UPDATE antrag SET vermst_id=\"$vermst_id\", az=\"$az\", vermart_id=\"$vermart_id\", ueb_datum=\"$ueb_datum\", ueb_aen=\"$ueb_aen\" WHERE id = $ida";
     mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht gelöscht werden...");
?>