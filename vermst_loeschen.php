<?php

include("function.php");
include("connect.php");

head_vermst();
nav_vermst();

$vermst_id=$_GET["vermst_id"];

echo "<p align=center>";
echo "Sie wollen den Satz mit der ID: ",$vermst_id," l&ouml;schen.<br>";
echo "<a href=\"vermst_auflistung.php\">Nein lieber doch nicht</a>
&nbsp;&nbsp;&nbsp;<a href=\"vermst_loeschen_eintragen.php?vermst_id=$vermst_id\">Ja, sicher</a>";

echo "</p>";
nav_vermst();
bottom();
?>