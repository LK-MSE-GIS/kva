
<?php
include ("connect_pgsql.php");
include ("baust_function.php");

$id=$_GET["id"];
$what=$_GET["what"];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=baust_list.php?what=$what\">
</head>";


$query="delete from fd_baustellen WHERE gid=$id";
 $result = $dbqueryp($connectp,$query);

bottom();
?>