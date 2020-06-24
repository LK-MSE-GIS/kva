<?php
include ("connect.php");
include ("li_function.php");




$id=$_GET["id"];
     $query="update li_a SET take_date='$print_datum',
                             take_mit_id='$mitarb_id' WHERE id = '$id';";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

 echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_a_liste.php?id=$id\">
</head>";

bottom();
?>