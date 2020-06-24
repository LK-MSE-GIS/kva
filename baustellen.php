<?php

include("connect.php");
include("function.php");

head_baustellen();

$query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%bau%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<table border=\"0\" text=\"#FCFDBF\"><tr><td style=\"font-family:Arial; font-size: 18pt; font-weight: bold\" colspan=\"3\">
         $r2[name]</td></tr>";
   echo "</table><br><br>";
   }
?>

<?php
bottom();
?>