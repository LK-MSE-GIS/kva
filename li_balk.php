<?php
include ("connect.php");
include ("li_function.php");

head_li_balk();
echo "Die letzten Eintr&auml;ge:<br>";
$countquery="SELECT id FROM li_balk ";
$recanz=li_count($dbname,$countquery);
$maxpage=$recanz/20;
$maxpage=absolute($maxpage);
$query="SELECT * from li_balk ";

li_balk_page($maxpage,$dbname,$query,'0');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$maxpage+1;
$prevpage=$maxpage-1;
if ($maxpage >0) echo "<a href=\"li_balk_all.php?page=$prevpage\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($maxpage < $maxpage) echo "<a href=\"li_balk_all.php?page=$nextpage\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";

bottom();
?>