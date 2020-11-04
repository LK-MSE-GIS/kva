<?php

include("connect.php");
include("function.php");

$id=$_POST["id"];
$gemarkung_id=$_POST["gemarkung_id"];
$flur=$_POST["flur"];
$flst_alt=$_POST["flst_alt"];
$flst_neu=$_POST["flst_neu"];

$ido=$_GET["ido"];
$page=$_GET["page"];

$what=$_POST["what"];
$status=$_POST["status"];
$lk=$_POST["lk"];
$number=$_POST["number"];
$year=$_POST["year"];
$ueb_aen=$_POST["ueb_aen"];

$vermst_id=$_POST["vermst_id"];

$gemark_id_1=$_POST["gemark_id_1"];
$flur_1=$_POST["flur_1"];
$flst_1=$_POST["flst_1"];
$flst_1alt=$_POST["flst_1alt"];



$vermart_id=$_POST["vermart_id"];
$ueb_datum=$_POST["ueb_datum"];

$az=$_POST["az"];
$sv=$_POST["sv"];




if ($page >0)  
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ido&page=$page&status=$status\">
</head>";
 else
echo "<head> <meta http-equiv=\"refresh\" content=\"0; URL=xant_aendern_alt.php?id=$ido&page=$page&status=$status\">
</head>";

	 
	 /*--------------EINTRAGUNG IN FLUREN2ANTRAG---------------*/
	   
	   $queryantrag="SELECT id FROM antrag WHERE lk Like '$lk' AND number='$number' AND year='$year' AND vermst_id='$vermst_id' AND vermart_id='$vermart_id'";
	  $idantrag=mysqli_query($db_link,$queryantrag);
	  $a1=mysqli_fetch_array($idantrag);
	   
	   $queryflur="INSERT INTO fluren2antrag (antrag,gemarkung_id,flur,flst_alt,flst_neu)
VALUES
('$a1[id]','$gemark_id_1','$flur_1','$flst_1alt','$flst_1');";

       mysqli_query($db_link,$queryflur) OR DIE ("Die Fluren konnten nicht angelegt werden...");

       echo "<p align=center>";


        $logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Antrag ".$number."/".$year." angelegt";

       write_log("verm.log",$logeintrag);

       echo "Der neue Eintrag wurde mit folgenden Grunddaten angelegt:";

      $query2="SELECT * FROM antrag WHERE year='$year' AND number='$number' AND lk ='$lk'";

      $result2=mysqli_query($db_link,$query2);

      $r2=mysqli_fetch_array($result2);

        echo "</b><br><br>";


?>