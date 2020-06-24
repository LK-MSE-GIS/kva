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
$query="SELECT * FROM antrag ";

if(($vermst_id>0) OR ($gemark_id>0)
                 OR ($flur != "")
                 OR ($flst != "")
                 OR ($vermart_id>0)
                 OR ($time_von != "")
                 OR ($time_bis != "")
                 OR ($sv != "")
                 OR ($az != "")
                 OR ($number > 0)
                 OR ($year != "")
                 OR ($riss != "")
                 OR ($hurry != "")
                 OR ($aktort_id>0)) $query=$query . "WHERE ";
$args=0;
if($number>0)
  {
  $query=$query . "number = '$number' ";
  $args=$args+1;
  }
if($year != "")
  {
  if ($args>0)
    {
     $query=$query."AND "." year LIKE '%$year' ";
    }
    else
    {
    $query=$query." year LIKE '%$year' ";
    }
   $args=$args+1;
   }
if($time_von != "")
  {
  if ($args>0)
    {
     $query=$query."AND ".$datart." >= '$time_von' ";
    }
    else
    {
    $query=$query.$datart." >= '$time_von' ";
    }
   $args=$args+1;
   }
if($time_bis != "")
  {
  if ($args>0)
    {
     $query=$query."AND ".$datart." <= '$time_bis' ";
    }
    else
    {
    $query=$query.$datart." <= '$time_bis' ";
    }
   $args=$args+1;
   }
if($vermst_id>0)
  {
  if ($args>0)
    {
     $query=$query."AND vermst_id = '$vermst_id' ";
    }
    else
    {
    $query=$query."vermst_id = '$vermst_id' ";
    }
   $args=$args+1;
  }

if($gemark_id>0 AND $flur == "" AND $flst=="")
  {
  if ($args>0)
    {
     $query=$query."AND ((gemark_id_1 = '$gemark_id') OR (gemark_id_2 = '$gemark_id') OR (gemark_id_3 = '$gemark_id')) ";
    }
    else
    {
    $query=$query."((gemark_id_1 = '$gemark_id') OR (gemark_id_2 = '$gemark_id') OR (gemark_id_3 = '$gemark_id')) ";
    }
   $args=$args+1;
  }
if($flur != "" AND $gemark_id > 0)
  {
  if ($args>0)
    {
     $query=$query."AND (((gemark_id_1 = '$gemark_id') AND (flur_1 LIKE '$flur')) OR ((gemark_id_2 = '$gemark_id') AND (flur_2 LIKE '$flur')) OR ((gemark_id_3 = '$gemark_id') AND (flur_3 LIKE '$flur'))) ";
    }
    else
    {
    $query=$query."(((gemark_id_1 = '$gemark_id') AND (flur_1 LIKE '$flur')) OR ((gemark_id_2 = '$gemark_id') AND (flur_2 LIKE '$flur')) OR ((gemark_id_3 = '$gemark_id') AND (flur_3 LIKE '$flur'))) ";
    }
   $args=$args+1;
  }
if($flst != "" AND $flur != "" AND $gemark_id > 0)
  {
  if ($args>0) $query=$query." AND ";
  $query=$query." ((gemark_id_1 = '$gemark_id' AND flur_1 LIKE '$flur') AND ((flst_1alt LIKE '$flst' OR flst_1 LIKE '$flst') OR (flst_1alt LIKE '$flst,%' OR flst_1 LIKE '$flst,%') OR (flst_1alt LIKE '$flst/%' OR flst_1 LIKE '$flst/%') OR (flst_1alt LIKE '%,$flst' OR flst_1 LIKE '%,$flst') OR (flst_1alt LIKE '%,$flst,%' OR flst_1 LIKE '%,$flst,%') OR (flst_1alt LIKE '%,$flst/%' OR flst_1 LIKE '%,$flst/%'))) OR ((gemark_id_2 = '$gemark_id' AND flur_2 LIKE '$flur') AND ((flst_2alt LIKE '$flst' OR flst_2 LIKE '$flst') OR (flst_2alt LIKE '$flst,%' OR flst_2 LIKE '$flst,%') OR (flst_2alt LIKE '$flst/%' OR flst_2 LIKE '$flst/%') OR (flst_2alt LIKE '%,$flst' OR flst_2 LIKE '%,$flst') OR (flst_2alt LIKE '%,$flst,%' OR flst_2 LIKE '%,$flst,%') OR (flst_2alt LIKE '%,$flst/%' OR flst_2 LIKE '%,$flst/%'))) OR ((gemark_id_3 = '$gemark_id') AND (flur_3 LIKE '$flur') AND ((flst_3alt LIKE '$flst' OR flst_3 LIKE '$flst') OR (flst_3alt LIKE '$flst,%' OR flst_3 LIKE '$flst,%') OR (flst_3alt LIKE '$flst/%' OR flst_3 LIKE '$flst/%') OR (flst_3alt LIKE '%,$flst' OR flst_3 LIKE '%,$flst') OR (flst_3alt LIKE '%,$flst,%' OR flst_3 LIKE '%,$flst,%') OR (flst_3alt LIKE '%,$flst/%' OR flst_3 LIKE '%,$flst/%'))) ";
    
   $args=$args+1;
  }
if($vermart_id >0)
  {
  if ($args>0)
    {
     $query=$query."AND vermart_id = '$vermart_id' ";
    }
    else
    {
    $query=$query."vermart_id = '$vermart_id' ";
    }
   $args=$args+1;
  }
if($az !="")
  {
  if ($args>0)
    {
     $query=$query."AND az LIKE '$az' ";
    }
    else
    {
    $query=$query."az LIKE '$az' ";
    }
   $args=$args+1;
  }
if($sv != "")
  {
  if ($args>0)
    {
     $query=$query."AND sv LIKE '%$sv%' ";
    }
    else
    {
    $query=$query."sv LIKE '%$sv%' ";
    }
   $args=$args+1;
  }
if($aktort_id >0)
  {
  if ($args>0)
    {
     $query=$query."AND aktort_id = '$aktort_id' ";
    }
    else
    {
    $query=$query."aktort_id = '$aktort_id' ";
    }
   $args=$args+1;
  }
if($riss != "")
  {
  if ($args>0)
    {
     if ($riss_op ==0) $query=$query."AND (((riss_1 = '$riss') AND (gemark_id_1 = '$gemark_id')) OR ((riss_2 = '$riss') AND (gemark_id_2 = '$gemark_id')) OR ((riss_3 = '$riss') AND (gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==1) $query=$query."AND (((riss_1 >= '$riss') AND (gemark_id_1 = '$gemark_id')) OR ((riss_2 >= '$riss') AND (gemark_id_2 = '$gemark_id')) OR ((riss_3 >= '$riss') AND (gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==2) $query=$query."AND ((riss_1 <= '$riss' AND riss_1 >= '1' AND gemark_id_1 = '$gemark_id') OR (riss_2 <= '$riss' AND riss_2 >= '1' AND gemark_id_2 = '$gemark_id') OR (riss_3 <= '$riss' AND riss_3 >= '1' AND gemark_id_3 = '$gemark_id')) ";
    }
    else
    {
     if ($riss_op ==0) $query=$query."(riss_1 = '$riss') OR (riss_2 = '$riss') OR (riss_3 = '$riss') ";

     if ($riss_op ==1) $query=$query."(((riss_1 >= '$riss') AND (gemark_id_1 = '$gemark_id')) OR ((riss_2 >= '$riss') AND (gemark_id_2 = '$gemark_id')) OR ((riss_3 >= '$riss') AND (gemark_id_3 = '$gemark_id'))) ";

     if ($riss_op ==2) $query=$query."((riss_1 <= '$riss' AND riss_1 >= '1' AND gemark_id_1 = '$gemark_id') OR (riss_2 <= '$riss' AND riss_2 >= '1' AND gemark_id_2 = '$gemark_id') OR (riss_3 <= '$riss' AND riss_3 >= '1' AND gemark_id_3 = '$gemark_id')) ";
    }
   $args=$args+1;
  }
if($hurry !="")
  {
  if ($args>0)
    {
     $query=$query."AND hurry = '$hurry' ";
    }
    else
    {
    $query=$query."hurry = '$hurry' ";
    }
   $args=$args+1;
  }
if (($time_von != "") OR ($time_bis != ""))
  {
   $query=$query." ORDER BY $datart";
  }
  else
  {
  $query=$query." ORDER BY year, number";
  }



if($args>0)
{
 $searchquery="update ant_search set query=\"$query\",tabtext='$tabtext',datart='$datart',gemark_id='$gemark_id',flur_id='$flur'  where mitarb_id='$mitarb_id';";

 mysql_query($searchquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");


}
else
{
 $fehler=1;
}

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_searchlist.php?fehler=$fehler&page=0&status=0\">
</head>";

bottom();
?>