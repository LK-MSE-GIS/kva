<?php
include ("connect.php");
include ("li_function.php");

head_li_c();
$id=$_GET["id"];
$countquery="SELECT id from li_c ;";
$recanz=li_count($dbname,$countquery);
$maxpage=$recanz/10;
$maxpage=absolute($maxpage);
$idquery="SELECT * from li_c WHERE id <= $id;";
$idposition=li_count($dbname,$idquery);
echo $idposition;
$page=$idposition/10;
$page=absolute($page);
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";
$query="SELECT * from li_c ";
li_c_page($page,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;
if ($page >0) echo "<a href=\"li_c_all.php?page=$prevpage&all=1\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_c_all.php?page=$nextpage&all=1\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>