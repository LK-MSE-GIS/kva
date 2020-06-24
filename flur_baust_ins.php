
<?php

include("connect.php");
include("connect_pgsql.php");

    $datum = getdate(time());
    $year=$datum[year];
    $month=$datum[mon];
    $day=$datum[mday];
    $hour=$datum[hours];
    $min=$datum[minutes];
    $sec=$datum[seconds];

    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($hour) == 1) $hour='0'.$hour;
    if (strlen($min) == 1) $min='0'.$min;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $akt_datum=$year."-".$month."-".$day;


$flur_id=$_GET["flur_id"];
$mitarb=$_GET["mitarb"];
$aktenz=$_GET["aktenz"];
$id=$_GET["id"];



echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_alkis.php?id=$id\">
</head>";


$flur_string=explode("-",$flur_id);
$gemarkung=$flur_string[0];
$flur=$flur_string[1];

$query="SELECT gemkgname from alb_v_gemarkungen WHERE gemkgschl='$gemarkung' ";

$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);
$gemkgname=$r[gemkgname];
$wo=$gemkgname.", Flur: ".$flur;
$was="Abgleich ALK-ALB";

$query="SELECT * from fd_baustellen WHERE wo='$wo' AND was='$was'";
$result = $dbqueryp($connectp,$query);
$count=0;
while($r = $fetcharrayp($result))
     {
       $count++;
     }


$query="SELECT objnr from alknflur WHERE gemkgschl='$gemarkung' AND flur='$flur'";

$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);
$objektnummer=$r[objnr];

$query="SELECT the_geom from alkobj_e_fla WHERE objnr='$objektnummer'";
echo $query;
$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);
$geometrie=$r[the_geom];

If ($count == '0')
 {

 $query="INSERT INTO fd_baustellen (wo,was,wer,wann,the_geom) VALUES ('$wo','$was','$mitarb','$akt_datum','$geometrie')";
 $result = $dbqueryp($connectp,$query);
 $r = $fetcharrayp($result);
 }
?>





