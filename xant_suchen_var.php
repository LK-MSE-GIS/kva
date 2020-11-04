<?php

include("connect.php");
include("function.php");



$fehler=0;
$number=$_POST["number"];
$year=$_POST["year"];
$vermst_id=$_POST["vermst_id"];
$gemark_id=$_POST["gemark_id"];
$flur=$_POST["flur"];
$flst=$_POST["flst"];
$vermart_id=$_POST["vermart_id"];
$time_von=$_POST["time_von"];
$time_bis=$_POST["time_bis"];
$sv=$_POST["sv"];
$az=$_POST["az"];
$aktort_id=$_POST["aktort_id"];
$datart=$_POST["datart"];
$hurry=$_POST["hurry"];




if ($datart=="eing_datum") $tabtext="Eingangsdatum";
if ($datart=="vorb_datum") $tabtext="Vorbereitung";
if ($datart=="me_datum") $tabtext="Messeingang";
if ($datart=="ueb_datum") $tabtext="&Uuml;bernahme";
if ($datart=="alk_datum") $tabtext="ALK-Datum";
if ($datart=="alb_datum") $tabtext="ALB-Datum";
if ($datart=="riss") $tabtext="Rissnummer";
$query="SELECT DISTINCT a.id FROM antrag as a, fluren2antrag as b WHERE a.id = b.antrag ";

$args=0;
if($number>0)
  {
  $query=$query . "AND a.number = '$number' ";
  $args++;
  }
if($year != "")
  {
   $query=$query."AND a.year LIKE '%$year' ";
   $args++;
   }
if($time_von != "")
  {
   $query=$query."AND ".$datart." >= '$time_von' ";
   $args++;
   }
if($time_bis != "")
  {
   $query=$query."AND ".$datart." <= '$time_bis' ";
   $args++;
   }
if($vermst_id>0)
  {
   $query=$query."AND a.vermst_id = '$vermst_id' ";
   $args++;
  }

if($gemark_id>0 AND $flur == "" AND $flst=="")
  {
   $query=$query."AND ((b.gemarkung_id = '$gemark_id')) ";
   $args++;
  }
if($flur != "" AND $gemark_id > 0)
  {
   $query=$query."AND (((b.gemarkung_id = '$gemark_id') AND (b.flur LIKE '$flur'))) ";
   $args++;
  }
if($flst != "" AND $flur != "" AND $gemark_id > 0)
  {
  if ($args>0) $query=$query." AND ";
  $query=$query." ((b.gemarkung_id = '$gemark_id' AND b.flur LIKE '$flur') AND ((b.flst_alt LIKE '$flst' OR b.flst_neu LIKE '$flst') OR (b.flst_alt LIKE '$flst,%' OR b.flst_neu LIKE '$flst,%') OR (b.flst_alt LIKE '$flst/%' OR b.flst_neu LIKE '$flst/%') OR (b.flst_alt LIKE '%,$flst' OR b.flst_neu LIKE '%,$flst') OR (b.flst_alt LIKE '%,$flst,%' OR b.flst_neu LIKE '%,$flst,%') OR (b.flst_alt LIKE '%,$flst/%' OR b.flst_neu LIKE '%,$flst/%'))) ";
    
   $args++;
  }
if($vermart_id >0)
  {
   $query=$query."AND a.vermart_id = '$vermart_id' ";
   $args++;
  }
if($az !="")
  {
   $query=$query."AND a.az LIKE '$az' ";
   $args++;
  }
if($sv != "")
  {
   $query=$query."AND a.sv LIKE '%$sv%' ";
   $args++;
  }
if($aktort_id >0)
  {
   $query=$query."AND a.aktort_id = '$aktort_id' ";
   $args++;
  }
if($riss != "")
  {
  if ($args>0)
    {
     if ($riss_op ==0) $query=$query."AND (((a.riss_1 = '$riss') AND (a.gemark_id_1 = '$gemark_id')) OR ((a.riss_2 = '$riss') AND (a.gemark_id_2 = '$gemark_id')) OR ((a.riss_3 = '$riss') AND (a.gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==1) $query=$query."AND (((a.riss_1 >= '$riss') AND (a.gemark_id_1 = '$gemark_id')) OR ((a.riss_2 >= '$riss') AND (a.gemark_id_2 = '$gemark_id')) OR ((a.riss_3 >= '$riss') AND (a.gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==2) $query=$query."AND ((a.riss_1 <= '$riss' AND a.riss_1 >= '1' AND a.gemark_id_1 = '$gemark_id') OR (a.riss_2 <= '$riss' AND a.riss_2 >= '1' AND a.gemark_id_2 = '$gemark_id') OR (a.riss_3 <= '$riss' AND a.riss_3 >= '1' AND a.gemark_id_3 = '$gemark_id')) ";
    }
    else
    {
     if ($riss_op ==0) $query=$query."(a.riss_1 = '$riss') OR (a.riss_2 = '$riss') OR (a.riss_3 = '$riss') ";

     if ($riss_op ==1) $query=$query."(((a.riss_1 >= '$riss') AND (a.gemark_id_1 = '$gemark_id')) OR ((a.riss_2 >= '$riss') AND (a.gemark_id_2 = '$gemark_id')) OR ((riss_3 >= '$riss') AND (gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==2) $query=$query."((a.riss_1 <= '$riss' AND a.riss_1 >= '1' AND a.gemark_id_1 = '$gemark_id') OR (a.riss_2 <= '$riss' AND a.riss_2 >= '1' AND a.gemark_id_2 = '$gemark_id') OR (a.riss_3 <= '$riss' AND a.riss_3 >= '1' AND a.gemark_id_3 = '$gemark_id')) ";
    }
   $args=$args+1;
  }
if($hurry !="")
  {
  if ($args>0)
    {
     $query=$query."AND a.hurry = '$hurry' ";
    }
    else
    {
    $query=$query."a.hurry = '$hurry' ";
    }
   $args=$args+1;
  }
if (($time_von != "") OR ($time_bis != ""))
  {
   $query=$query." ORDER BY $datart";
  }
  else
  {
  $query=$query." ORDER BY a.year, a.number";
  }



if($args>0)
{
 $searchquery="update ant_search set query=\"$query\",tabtext='$tabtext',datart='$datart',gemark_id='$gemark_id',flur_id='$flur'  where mitarb_id='$mitarb_id';";

 mysqli_query($db_link,$searchquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


}
else
{
 $fehler=1;
}


echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=xant_searchlist.php?fehler=$fehler&page=0&status=0\">
</head>";

bottom();
?>