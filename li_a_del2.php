<head>
<meta http-equiv="refresh" content="0; URL=li_a_search.php">
</head>

<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];

$query="delete from li_a WHERE id=$id";
   mysql_query($query) OR DIE ("Es konnt nicht gel&ouml;scht werden...");
bottom();
?>