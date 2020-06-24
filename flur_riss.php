
<?php

include("connect.php");
include("function.php");

$gemark_id=$_GET["gemark_id"];
$id=$_GET["id"];

head_flur();
nav_flur("nachweise");

flur_kopf($id,$dbname);


echo"</table>";

$query="SELECT * from riss_nummer where gemark_id = '$gemark_id';";
$result=mysql_query($query);
$r=mysql_fetch_array($result);
$rissnummer=$r[last_riss]+1;

echo "<div align=center><font face=\"arial\">
Die nächste freie Rissnummer ist:<br><br>
<h1>$rissnummer</h1><br><br>

<a href=\"flur_riss_ins.php?gemark_id=$gemark_id&id=$id&riss=$rissnummer\">annehmen</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"nachweise.php?id=$id\">nicht annehmen</a>";


bottom();
?>