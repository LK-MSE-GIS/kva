<?php

include("connect.php");

$start_id=$_POST["start_id"];
$anzahl=$_POST["anzahl"];
$head=$_POST["head"];
$comment=$_POST["comment"];
$titel=$_POST["titel"];
$photographer=$_POST["photographer"];

$end_id=$start_id+$anzahl;

for ($i=$start_id;$i<$end_id;$i++)
  {
   echo "Bild $i eingefügt.<br>";
   $query="INSERT INTO pictures (id,head,comment,titel,photographer) VALUES ('$i','$head','$comment','$titel','$photographer')";
   mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  }

?>