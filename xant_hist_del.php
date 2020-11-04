
<?php

include("connect.php");
include("function.php");


$id=$_GET["id"];
$page=$_GET["page"];
$status=$_GET["status"];

if ($page >0)  
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_searchlist.php?page=$page&status=$status\">
</head>";
 else
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_suchen.php\">
</head>";


$checkquery="SELECT * from fluren2antrag WHERE antrag = '$id'";
$checkresult=mysqli_query($db_link,$checkquery);
$count=0;
     while($cr=mysqli_fetch_array($checkresult))
      {
       $count++;
       }
 if ($count > 0)
   {
     $query="DELETE FROM fluren2antrag WHERE antrag = '$id'";
     mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht gelöscht werden...");
   }

$query="DELETE FROM antrag WHERE id = '$id'";
mysqli_query($db_link,$query) OR DIE ("Der Eintrag konnte nicht gelöscht werden...");


?>