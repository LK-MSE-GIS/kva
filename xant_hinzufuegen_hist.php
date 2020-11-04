<?php

include("connect.php");
include("function.php");

xhead_ant();
xmain_nav();
xnav_ant();

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



$vermart_id=$_POST["vermart_id"];
$ueb_datum=$_POST["ueb_datum"];

$az=$_POST["az"];
$sv=$_POST["sv"];

$aktort_id=7;

 if ($what == 'insert')
{

$checkquery="SELECT * FROM antrag WHERE year='$year' AND number='$number' AND lk ='$lk' AND flur_1='$flur_1' AND flst_1='$flst_1' AND flst_1alt='$flst_1alt'";

$checkresult=mysqli_query($db_link,$checkquery);

if ($checkr=mysqli_fetch_array($checkresult))
     {
      echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">Den Eintrag gibt es schon.<br></div>";
     }
     else
     {


	   
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




	  
	  
	  
	  /*------------ANZEIGEN VON FORHANDENEN DATENSÄTZEN------------*/

echo "<div class=\"ausgabe_bereich\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">";
  echo "<form action=\"xant_hinzufuegen_hist.php\" method=\"post\" target=\"\">
  <input type=hidden name=\"what\" value=\"insert\">
  <table class=\"alter_eintrag_table\" border=\"0\" >
  <tr style=\"font-weight: bold\">
   <td> Antrag einfügen</td>
   <input type=hidden name=\"number\" value=\"$number\">
   <input type=hidden name=\"year\" value=\"$year\">
   <input type=hidden name=\"lk\" value=\"$lk\">
   <input type=hidden name=\"vermart_id\" value=\"$vermart_id\">
   <input type=hidden name=\"vermst_id\" value=\"$vermst_id\">
   <td colspan=\"3\">&nbsp;$number&nbsp;<b>/</b>&nbsp;$year&nbsp;&nbsp;&nbsp;&nbsp;Landkreis:
   &nbsp;$lk&nbsp;&nbsp;&nbsp;&nbsp;ÄG: <input type=\"Text\" name=\"ueb_aen\" value=\"\" size=\"9\" maxlength=\"9\">
    </td>
   </tr>
   <tr class=\"alter_eintrag_beschriftung\">
   <td>Vermessungsstelle</td>
   <td>Az(Vmst.)</td>
   <td>Vermessungsart</td>
   <td>Datum</td>
   </tr>";
	  
	  
	  
	  
	$querydaten="SELECT * FROM antrag as a, fluren2antrag as b WHERE a.number='$number' AND a.year='$year' AND a.lk Like '$lk' AND a.id = b.antrag";
    $resultd=mysqli_query($db_link,$querydaten);
     while($rd=mysqli_fetch_array($resultd))
      {
       echo "
    <tr class=\"alter_eintrag_beschriftung\">
    <td>Gemarkung/Flur</td>
    <td>&nbsp;</td>
    <td colspan=\"2\">Flurstück</td>
    </tr>
    <tr>
     <td> $rd[gemarkung_id]";
	 
	 $querygemark="SELECT * FROM gemarkung WHERE gemark_id = $rd[gemarkung_id]";
	 $resultgemark=mysqli_query($db_link,$querygemark);
	 $rg=mysqli_fetch_array($resultgemark);
	 
	   echo " $rg[gemarkung]<br><br>
    Flur: $rd[flur]
    </td>
    <td align=\"right\" valign=\"top\"></td>
    <td colspan=\"2\">alt: $rd[flst_alt]<br>
    neu: $rd[flst_neu]
    </td>
    </tr>
        <tr>
     <td>";
       } 
	   
	   
	   
	   
	   
	   

	  
	  echo "</table></h2></td>
       </tr>
       <tr style=\"height: 20px;\">
       <td colspan=\"2\" align =\"center\"><a class=\"alter_eintrag_button\" href=\"xant_eintrag_hist.php?lk=$lk&number=$number&year=$year&vermst_id=$vermst_id&vermart_id=$vermart_id&az=$az&ueb_datum=$ueb_datum&gemark_id_1=$gemark_id_1\">+Gemarkung hinzufügen</a> </td>
      </tr>
      </table><br>";
      }
	  
};





xnav_ant();
bottom();
?>