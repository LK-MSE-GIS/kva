<?php
include ("connect.php");
include ("li_function.php");

head_li_a();
echo "Die letzten Eintr&auml;ge:<br>";
$countquery="SELECT id from li_a ;";
$recanz=li_count($dbname,$countquery);
$maxpage=$recanz/10;
$maxpage=absolute($maxpage);
$query="SELECT * from li_a ";
li_a_page($maxpage,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$maxpage+1;
$prevpage=$maxpage-1;
if ($maxpage >0) echo "<a href=\"li_a_all.php?page=$prevpage&all=1\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($maxpage < $maxpage) echo "<a href=\"li_a_all.php?page=$nextpage&all=1\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>