<?php
include ("connect.php");
include ("li_function.php");

head_li_a();
$page=$_GET["page"];
$all=$_GET["all"];

$countquery="SELECT id from li_a ";
if ($all != '1') $countquery=$countquery." where year='$year';";
$recanz=li_count($dbname,$countquery);
$maxpage=$recanz/10;
$maxpage=absolute($maxpage);
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";
$query="SELECT * from li_a ";
if ($all !='1') $query=$query." where year='$year'";
li_a_page($page,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;
if ($page >0) echo "<a href=\"li_a_all.php?page=$prevpage&all=$all\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_a_all.php?page=$nextpage&all=$all\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>