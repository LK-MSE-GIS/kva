<?php

include("connect.php");
include("function.php");

$query="SELECT * FROM antrag;";
$result=mysql_db_query($dbname,$query);
while($r=mysql_fetch_array($result))
  {
  $year=substr($r[eing_datum],0,4);
  $number=$r[id];
  $update_query="UPDATE antrag set number='$number', year='$year' where id='$r[id]';";
  mysql_query($update_query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  }
echo "Das wars...";
?>