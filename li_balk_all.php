<?php
include ("connect.php");
include ("li_function.php");

head_li_balk();
$page=$_GET["page"];
$countquery="SELECT id from li_balk;";
$recanz=li_count($dbname,$countquery);
$maxpage=$recanz/20;
$maxpage=absolute($maxpage);
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";
$query="SELECT * from li_balk";
li_balk_page($page,$dbname,$query,'0');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;
if ($page >0) echo "<a href=\"li_balk_all.php?page=$prevpage\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_balk_all.php?page=$nextpage\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>