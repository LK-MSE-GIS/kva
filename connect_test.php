<?php

$server='mysql-server';
$nutzer="kvwmap";
$password="Kvwmap_13071";
$dbname="kva";

$db_link=mysqli_connect($server,$nutzer,$password);
if (!$db_link) {
    die('Verbindung nicht möglich : ' . mysqli_error());
  }

mysqli_select_db($db_link,$dbname);
mysqli_query($db_link,"SET NAMES 'utf8'");


$logname=$_SERVER['REMOTE_USER'];

$workquery="SELECT * FROM mitarbeiter WHERE logname LIKE '$logname'";

$workresult=mysqli_query($db_link,$workquery);
$workr=mysqli_fetch_array($workresult);
$username=$workr["name"];
$abteilung=$workr["abteilung"];
$mitarb_id=$workr["mitarb_id"];

echo "Name:",$workr["name"]," <br>";
echo "Abteilung: ",$abteilung;
?>

<table border=1>
<tr><td>Name</td><td><? echo $username; ?></td></tr>
</table>