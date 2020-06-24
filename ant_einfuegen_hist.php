<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();

$what=$_POST["what"];
$id=$_POST["id"];
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


$gemark_id_2=$_POST["gemark_id_2"];
$flur_2=$_POST["flur_2"];
$flst_2=$_POST["flst_2"];
$flst_2alt=$_POST["flst_2alt"];


$gemark_id_3=$_POST["gemark_id_3"];
$flur_3=$_POST["flur_3"];
$flst_3=$_POST["flst_3"];
$flst_3alt=$_POST["flst_3alt"];


$vermart_id=$_POST["vermart_id"];
$ueb_datum=$_POST["ueb_datum"];

$az=$_POST["az"];
$sv=$_POST["sv"];

$aktort_id=7;


 if ($what == 'insert')
{

$checkquery="SELECT * FROM antrag WHERE year='$year' AND number='$number' AND lk ='$lk'";

$checkresult=mysql_query($checkquery,$db_link);

if ($checkr=mysql_fetch_array($checkresult))
     {
      echo "Den Eintrag gibt es schon.<br>";
     }
     else
     {

       $query="INSERT INTO antrag (lk,number,year,vermst_id,gemark_id_1,flur_1,flst_1,flst_1alt,gemark_id_2,flur_2,flst_2,flst_2alt,gemark_id_3,flur_3,flst_3,flst_3alt,vermart_id,ueb_datum,az,sv,aktort_id,hurry,ueb_aen)
VALUES
('$lk','$number','$year','$vermst_id','$gemark_id_1','$flur_1','$flst_1','$flst_1alt','$gemark_id_2','$flur_2','$flst_2','$flst_2alt','$gemark_id_3','$flur_3','$flst_3','$flst_3alt','$vermart_id','$ueb_datum','$az','$sv','$aktort_id','0','$ueb_aen');";

       mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

       echo "<p align=center>";


        $logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Antrag ".$number."/".$year." angelegt";

       write_log("verm.log",$logeintrag);

       echo "Der neue Eintrag wurde mit folgenden Grunddaten angelegt:";

      $query2="SELECT * FROM antrag WHERE year='$year' AND number='$number' AND lk ='$lk'";

      $result2=mysql_query($query2,$db_link);

      $r2=mysql_fetch_array($result2);

        echo "</b><br><br>


      <table border=\"2\">
      <tr>
      <td width=\"190\" bgcolor=\"#a0a0a0\">Antragsnummer: </td>
      <td><h2>$number/$year </h2></td>
       </tr>
       <tr>
       <td colspan=\"2\" align =\"center\"><a href=\"ant_aendern_alt.php?id=$r2[id]\">Bearbeiten</a> </td>
      </tr>
      </table><br>";
      }




}

if ($what == 'edit')
    {
     $query="UPDATE antrag SET 
                 vermst_id='$vermst_id',
                 gemark_id_1='$gemark_id_1',
                 flur_1='$flur_1',
                 flst_1='$flst_1',
                 flst_1alt='$flst_1alt',
                 gemark_id_2='$gemark_id_2',
                 flur_2='$flur_2',
                 flst_2='$flst_2',
                 flst_2alt='$flst_2alt',
                 gemark_id_3='$gemark_id_3',
                 flur_3='$flur_3',
                 flst_3='$flst_3',
                 flst_3alt='$flst_3alt',
                 vermart_id='$vermart_id',
                 ueb_datum='$ueb_datum',
                 ueb_aen='$ueb_aen',
                 az='$az',
                 sv='$sv',
                 aktort_id='7'  WHERE id='$id';";


 
     mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
    echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_aendern_alt.php?id=$id&page=$page&status=$status\">
</head>";
    }

nav_ant();
bottom();
?>