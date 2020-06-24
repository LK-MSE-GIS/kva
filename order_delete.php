<?php

include("connect.php");
include("function.php");

nav_orders();

$id=$_GET["id"];
$order_key=$_GET["order_key"];
$order_addr1=$_GET["order_addr1"];

echo "<div align=\"center\">
  <h3>Auftrag löschen</h3><br>
  M&ouml;chten Sie wirklich den folgenden Auftrag löschen:<br>
  Auftraggeber:&nbsp;$order_addr1<br>
  Auftragsnummer:&nbsp;$order_key<br><br>";

echo "<a href=\"order_rm.php?id=$id&order_key=$order_key\">Ja</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"order_search.php\">Nein</a><br><br>";

  nav_orders();
  bottom();
?>