<head>
<meta http-equiv="refresh" content="0; URL=adr_liste.php">
</head>

<?php
include ("connect_pgsql.php");

$id=$_GET["id"];



$query="delete from alb_g_namen_temp WHERE oid=$id";
 $result = $dbqueryp($connectp,$query);

bottom();
?>
