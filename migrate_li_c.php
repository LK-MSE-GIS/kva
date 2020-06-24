<?php

include("connect.php");
include("function.php");
$count=0;
$query="SELECT * FROM li_c_alt ORDER BY year,number;";
$result=mysql_db_query($dbname,$query);
while($r=mysql_fetch_array($result))
  {
  $insert_query="INSERT INTO li_c (year,number,bem,grubu,fa_bem,date,mit_id) VALUES ('$r[year]','$r[number]','$r[bem]','$r[grubu]','$r[fa_bem]','$r[date]','$r[mit_id]')";
  mysql_query($insert_query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  $count++;
  }
echo "Das wars...$count";
?>