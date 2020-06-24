<?php

include("connect.php");





$id=$_GET["id"];
$feld=$_GET["feld"];


 

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_alkis.php?id=$id\">
</head>";



$query5="UPDATE flur set $feld='-1' WHERE id=$id;";
mysql_query($query5) OR DIE ("Der Eintrag konnte nicht angelegt werden...");





?>