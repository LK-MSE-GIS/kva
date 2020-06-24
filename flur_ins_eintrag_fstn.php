<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("alkgrund");


$gemarkung=$_POST["gemarkung"];
$flur=$_POST["flur"];
$zaehler=$_POST["zaehler"];
$nenner=$_POST["nenner"];
$comment=$_POST["comment"];
$id=$_POST["id"];

    $fstnquery="SELECT * FROM fstn WHERE gemarkung=$gemarkung AND flur=$flur AND zaehler=$zaehler";
     $fstnresult=mysql_query($fstnquery);
     $fstn=0;
     echo "<table border=\"1\"><tr>";
     while($fstnr=mysql_fetch_array($fstnresult))
      {
      echo "<td width=\"30\"><a href=\"flur_edit_fstn.php?gemarkung=$gemarkung&flur=$flur&zaehler=$zaehler&id=$id\">$fstnr[zaehler]&nbsp;<small>$fstnr[nenner]</small></a><td>";
      $fstn=$fstn+1;
      $quot=$fstn%15;
      if($quot ==0) echo "</tr><tr>";

echo "</tr></table><br><br>Den Zähler gibt es schon...<br><br><a href=\"flur_show_fstn.php?id=$id\">[Weiter]</a><br><br>";
     }
     if ($fstn==0)
   {


   $query="INSERT INTO fstn (gemarkung,flur,zaehler,nenner,comment) VALUES  ('$gemarkung','$flur','$zaehler','$nenner','$comment');";
   mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   echo "<p align=center>";
?>
<img src="images\ok.jpg" alt="" border="0"><br><br>
<?php
echo "Neuer Zähler eingetragen.<br><br>";

echo "<a href=\"flur_show_fstn.php?id=$id\">[Weiter]</a><br><br>";
echo "</b>";
}
nav_ant("alkgrund");
bottom();
?>