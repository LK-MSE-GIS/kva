
<?php

include("connect.php");
include("function.php");


$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

if ($page >0)  
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=ant_searchlist.php?page=$page&status=$status\">
</head>";
 else
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=ant_suchen.php\">
</head>";


$checkquery="SELECT * from risse2antrag WHERE antrag_id = '$id'";
$checkresult=mysql_query($checkquery,$db_link);
$count=0;
     while($cr=mysql_fetch_array($checkresult))
      {
       $count++;
       }
 if ($count > 0)
   {
     $query="DELETE FROM risse2antrag WHERE antrag_id = '$id'";
     mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

$query="DELETE FROM antrag WHERE id = '$id'";
mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


?>