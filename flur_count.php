<?php

include("connect.php");
include("function.php");

$selquery="SELECT * from flur ORDER BY gemkg_id,flur_id";
$result=mysql_query($selquery);
$treffer=0;
while($r=mysql_fetch_array($result))
  {
   
   $update_query="UPDATE flur set ID = '$treffer' WHERE gemkg_id='$r[gemkg_id]' AND flur_id='$r[flur_id]';";
   $treffer=$treffer+1;
mysql_query($update_query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

  }
?>