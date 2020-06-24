<?php
include ("connect_pgsql.php");
$flst=$_GET["flst"];
$name=$_GET["name"];
$flur=$_GET["flur"];
$nummer=$_GET["nummer"];
$stichtag=$_GET["stichtag"];

function changecolor($farbe)
 {
  if ($farbe=="#D8DCDE") $farbe="#FCFCFC";
  else $farbe="#D8DCDE";
  return $farbe;
 }   
    $datum = getdate(time());
    $year=$datum[year];
    $month=$datum[mon];
    $day=$datum[mday];
    $wday=$datum[wday];
    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$day.".".$month.".".$year;
    $bday_datum=$month."-".$day;


?>
<body link=#000000 alink=#000000 vlink=#000000>
<font face="Arial">

  <table>
    <tr>
      <td align=left width=150><img src="images/wappenlkm.gif" width="100" height="120" border="0" alt=""></td>
      <td width=200>Landkreis Müritz<br>Die Landrätin<br><small>Kataster- und Vermessungsamt<br>Zum Amtsbrink2<br>17192 Waren(Müritz)<br>Telefon:03991-782488</small></td>
<td width=200 align=right valign=top><?php echo $print_datum; ?></td>
    </tr>
   </table><br>

<div align="center">

<h2>Bodenrichtwert</h2>
<br>

<?php

echo "Stichtag: $stichtag<br>";


  $query="select intersection(o.the_geom,f.the_geom) AS intersection_geom,round(area(intersection(o.the_geom,f.the_geom))) as flaeche,round(area(f.the_geom)) as flst_flaeche,o.oid as id,o.* FROM bw_bodenrichtwertzonen as o, flurstuecke as f WHERE o.the_geom && f.the_geom AND intersects(o.the_geom,f.the_geom) AND f.geographicidentifier='$flst' AND o.datum LIKE '$stichtag' AND area(intersection(o.the_geom,f.the_geom))>0";

  $result = $dbqueryp($connectp,$query);


  $r = $fetcharrayp($result);
   
  $gquery="SELECT gemeindename FROM alb_v_gemeinden WHERE gemeinde=$r[gemeinde_id]";

  $gresult = $dbqueryp($connectp,$gquery);
  $gr = $fetcharrayp($gresult); 

echo "<br><u>Flurstück</u><br>Gemarkung: $name<br>Flur: $flur<br>Flurstück: $nummer<br><br>"; 

echo "<table>
     <tr>
     <td width=300>Gemeinde:</td>
     <td>",$gr[0],"</td>
     </tr>
     <tr>
     <td width=300>Zone:</td>
     <td>",$r[zonennr],"</td>
     </tr>
     <tr>
     <td width=300>Standort:</td>
     <td>",$r[standort],"</td>
     </tr>
     <tr>
     <td width=300>Richtwertdefinition:</td>
     <td>",$r[richtwertdefinition],"</td>
     </tr>
     <tr>
     <td width=300>Erschließungsart:</td>
     <td>",$r[erschliessungsart],"</td>
     </tr>
     <tr>
     <td width=300>Bodenwert:</td>
     <td>",$r[bodenwert],"</td>
     </tr>
     <tr>
     <td width=300>Sanierungsgebiete:</td>
     <td>",$r[sanierungsgebiete],"</td>
     </tr>
     </table>";


?>