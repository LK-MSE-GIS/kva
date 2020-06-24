<?php

include("connect.php");
include("function.php");
$count=0;
$query="SELECT * FROM li_b_alt ORDER BY year,number;";
$result=mysql_db_query($dbname,$query);
while($r=mysql_fetch_array($result))
  {
  $insert_query="INSERT INTO li_b (year,number,fma,flst,fa_bem,date,mit_id) VALUES ('$r[year]','$r[number]','$r[fma]','$r[flst]','$r[fa_bem]','$r[date]','$r[mit_id]')";
  mysql_query($insert_query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  $count++;
  }
echo "Das wars...$count";
?>