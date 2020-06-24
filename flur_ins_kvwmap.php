<?php

include("connect.php");
include("function.php");


head_flur();
nav_flur("kvwmap");


$id=$_POST["id"];
$gesc_riss_dat=$_POST["gesc_riss_dat"];
$all_riss_dat=$_POST["all_riss_dat"];
$gesc_riss_kvz=$_POST["gesc_riss_kvz"];
$all_riss_kvz=$_POST["all_riss_kvz"];
$gesc_riss_mitid=$_POST["gesc_riss_mitid"];
$all_riss_mitid=$_POST["all_riss_mitid"];
$anlagen_mitid=$_POST["anlagen_mitid"];
$georef_mitid=$_POST["georef_mitid"];
$anlagen_dat=$_POST["anlagen_dat"];
$georef_dat=$_POST["georef_dat"];
$gn_scan_date=$_POST["gn_scan_date"];
$gn_scan_mitid=$_POST["gn_scan_mitid"];
$nachb_date=$_POST["nachb_date"];
$nachb_mitid=$_POST["nachb_mitid"];
$erf_nachweise_mitarbeiter=$_POST["erf_nachweise_mitarbeiter"];
$erf_nachweise_date=$_POST["erf_nachweise_date"];

if ((($gesc_riss_dat=='0000-00-00') AND ($gesc_riss_kvz=='1')) OR (($all_riss_dat=='0000-00-00') AND ($all_riss_kvz=='1')))
{
echo "Sie haben kein Datum eigegeben..";
error();
echo "<br><a href=\"flur_edit_kvwmap.php?id=$id\">Zurück</a>";
}
else
{
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=flur_edit_kvwmap.php?id=$id\">
</head>";
$query="UPDATE flur
           SET all_riss_dat='$all_riss_dat',
               gesc_riss_dat='$gesc_riss_dat',
			   erf_nachweise_date='$erf_nachweise_date',
			   erf_nachweise_mitarbeiter='$erf_nachweise_mitarbeiter',
               anlagen_dat='$anlagen_dat',
               anlagen_mitid='$anlagen_mitid',
               georef_dat='$georef_dat',
               gn_scan_date='$gn_scan_date',
               nachb_mitid='$nachb_mitid',
               nachb_date='$nachb_date',
               gn_scan_mitid='$gn_scan_mitid',
               georef_mitid='$georef_mitid',
               gesc_riss_kvz='$gesc_riss_kvz',
               all_riss_kvz='$all_riss_kvz',
               gesc_riss_mitid='$gesc_riss_mitid',
               all_riss_mitid='$all_riss_mitid'
               WHERE ID='$id';";

mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$logeintrag=$year."-".$month."-".$day." ".$hour.":".$min.":".$sec." ".$username." Flur mit der ID:".$id." Eintrag Digitales Rissarchiv geaendert";

write_log("fluren.log",$logeintrag);

}

nav_flur("kvwmap");
bottom();
?>