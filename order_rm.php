<?php

include("connect.php");
include("function.php");

nav_orders();

$id=$_GET["id"];
$order_key=$_GET["order_key"];

$delquery="DELETE FROM orders WHERE id = '$id';";
mysql_query($delquery) OR DIE ("Es konnte nicht gel&ouml;scht werden...");

ok();
echo "Der Auftrag: ",$order_key," wurde gelöscht.<br><br>";





  nav_orders();
  bottom();
?>