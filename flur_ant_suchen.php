<?php

include("connect.php");
include("function.php");





$id=$_GET["id"];

$query="SELECT * from antrag WHERE id='$id'";
$tabtext="Ergebnis";

 $searchquery="update ant_search set query=\"$query\",tabtext='$tabtext',datart='$datart',gemark_id='$gemark_id',flur_id='$flur'  where mitarb_id='$mitarb_id';";

 mysql_query($searchquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");



echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_searchlist.php?fehler=$fehler&page=0&status=0\">
</head>";

bottom();
?>