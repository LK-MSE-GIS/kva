<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");



$query="SELECT * FROM antrag ";
$result=mysql_query($query,$db_link);
while ($r=mysql_fetch_array($result))
 {
   if ($r[gemark_id_1] > 0 AND $r[riss_1] > 0)
     {
       $insquery="INSERT INTO risse2antrag (antrag_id,gemark_id,riss_id) VALUES ('$r[id]','$r[gemark_id_1]','$r[riss_1]')";
      echo $insquery,"<br>";
       mysql_query($insquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
     }
   if ($r[gemark_id_2] > 0 AND $r[riss_2] > 0)
     {
       $insquery="INSERT INTO risse2antrag (antrag_id,gemark_id,riss_id) VALUES ('$r[id]','$r[gemark_id_2]','$r[riss_2]')";
      echo $insquery,"<br>";
       mysql_query($insquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
     }
   if ($r[gemark_id_3] > 0 AND $r[riss_3] > 0)
     {
       $insquery="INSERT INTO risse2antrag (antrag_id,gemark_id,riss_id) VALUES ('$r[id]','$r[gemark_id_3]','$r[riss_3]')";
      echo $insquery,"<br>";
       mysql_query($insquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
     }
 }


?>