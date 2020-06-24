<?php

include("connect.php");
include("function.php");
$count=0;
$query="SELECT * FROM li_a_alt ORDER BY year,number;";
$result=mysql_db_query($dbname,$query);
while($r=mysql_fetch_array($result))
  {
  $insert_query="INSERT INTO li_a (year,number,antrag,flst1,flst2,flst3,flst4,vermart_id,vorb_date,vorb_mit_id,take_date,take_mit_id) VALUES ('$r[year]','$r[number]','$r[antrag]','$r[flst1]','$r[flst2]','$r[flst3]','$r[flst4]','$r[vermart_id]','$r[vorb_date]','$r[vorb_mit_id]','$r[take_date]','$r[take_mit_id]')";
  mysql_query($insert_query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  $count++;
  }
echo "Das wars...$count";
?>