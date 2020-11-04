<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

$new=$_GET["new"];

xhead_ant();
xmain_nav();
head_flur();
nav_flur("alkgrund");
echo "<div class=\"ausgabe_bereich\">";

$fgesamt=0;
$query="SELECT count(*) from flur WHERE hist = '0';";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);
$fgesamt=$r[0];
   

if ($new=='ja')  #Start der Aktualisierung
{

$pgquery="update fd_fluren set risse='0',abgleich='0',vormi='0',einm='0',bos='0'";
$pgresult = $dbqueryp($connectp,$pgquery);


$query="SELECT * FROM flur";
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
 {
  if ($r[alkis_feldnutz_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_feldnutz_anr]'";
     $anrresult=mysqli_query($anrquery);
     $anrr=mysqli_fetch_array($anrresult);
     $alkis_feldok_dat=$anrr[alk_datum];
     $alkis_feldorder_dat=$anrr[eing_datum];
     $az=$anrr[number]."/".$anrr[year];
     if ($alkis_feldok_dat != '0000-00-00')
        $updatequery="UPDATE flur set alkis_feldok_dat ='$alkis_feldok_dat', alkis_feldorder_dat='$alkis_feldorder_dat', alkis_feldnutz_stat='2' where id='$r[ID]'";
        else
         $updatequery="UPDATE flur set alkis_feldok_dat ='$alkis_feldok_dat', alkis_feldorder_dat='$alkis_feldorder_dat' where id='$r[ID]'";
       mysqli_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

   }

  if ($r[alkis_flber_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_flber_anr]'";
     $anrresult=mysqli_query($anrquery);
     $anrr=mysqli_fetch_array($anrresult);
     $alkis_flber_dat=$anrr[alk_datum];
     $alkis_florder_dat=$anrr[eing_datum];
     $flberaz=$anrr[number]."/".$anrr[year];
     $updatequery="UPDATE flur set alkis_flber_dat ='$alkis_flber_dat', alkis_florder_dat='$alkis_florder_dat' where id='$r[ID]'";
     mysqli_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

  if ($r[alkis_fldig_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_fldig_anr]'";
     $anrresult=mysqli_query($anrquery);
     $anrr=mysqli_fetch_array($anrresult);
     $alkis_fldig_dat=$anrr[alk_datum];
     $alkis_fldigord_dat=$anrr[eing_datum];
     $fldigaz=$anrr[number]."/".$anrr[year];
     $updatequery="UPDATE flur set alkis_fldig_dat ='$alkis_fldig_dat', alkis_fldigord_dat='$alkis_fldigord_dat' where id='$r[ID]'";
     mysqli_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

$stat=0;

if (($r[alkis_flber_anr] > 0 AND $r[alkis_flber_dat] != '0000-00-00') AND $r[alkis_fldig_anr] == '-1') $stat=$stat+2;
if (($r[alkis_fldig_anr] > 0 AND $r[alkis_fldig_dat] != '0000-00-00') AND $r[alkis_flber_anr] == '-1') $stat=$stat+2;
if (($r[alkis_flber_anr] > 0 AND $r[alkis_flber_dat] != '0000-00-00') AND ($r[alkis_fldig_anr] > 0 AND $r[alkis_fldig_dat] != '0000-00-00')) $stat=$stat+2;

if ($stat == '2')
    {
     $updatequery="UPDATE flur set alkis_fl_stat ='4' where id='$r[ID]'";
     mysqli_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }    

if ($r[alkis_flber_anr] == '-1' AND $r[alkis_fldig_anr] == '-1')
    {
     $updatequery="UPDATE flur set alkis_fl_stat ='5' where id='$r[ID]'";
     mysqli_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   } 

 }


$fselekt=43;
$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
$sel_result=mysqli_query($sel_query);
$sel_r=mysqli_fetch_array($sel_result);
$query=$sel_r[query];
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
  {
   $gemarkung=$r[gemkg_id];
   $flur=vor_null($r[flur_id],3);
   $pgquery="UPDATE fd_fluren set einm='1' where gemkg='$gemarkung' AND flur='$flur'";
   $pgresult = $dbqueryp($connectp,$pgquery);
   }




$sel_query="SELECT * from selekt ";
$sel_result=mysqli_query($sel_query);
while($sel_r=mysqli_fetch_array($sel_result))
  {
   $count=0;
   $query=$sel_r[query];
   $result=mysqli_query($query);
   while($r=mysqli_fetch_array($result))
    {
     $count++;
    }
   $wertquery="UPDATE selekt set wert='$count',aktualisierung='$print_datum' WHERE sel_id=$sel_r[sel_id]";
   $wertresult=mysqli_query($wertquery);
  }



$fselekt=71;
$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
$sel_result=mysqli_query($sel_query);
$sel_r=mysqli_fetch_array($sel_result);
$query=$sel_r[query];
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
  {
   $gemarkung=$r[gemkg_id];
   $flur=vor_null($r[flur_id],3);
   $pgquery="UPDATE fd_fluren set bos='1' where gemkg='$gemarkung' AND flur='$flur'";
   $pgresult = $dbqueryp($connectp,$pgquery);
   }




$fselekt=99;
$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
$sel_result=mysqli_query($sel_query);
$sel_r=mysqli_fetch_array($sel_result);
$query=$sel_r[query];
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
  {
   $gemarkung=$r[gemkg_id];
   $flur=vor_null($r[flur_id],3);
   $pgquery="UPDATE fd_fluren set abgleich='1' where gemkg='$gemarkung' AND flur='$flur'";
   $pgresult = $dbqueryp($connectp,$pgquery);
   }




$fselekt=105;
$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
$sel_result=mysqli_query($sel_query);
$sel_r=mysqli_fetch_array($sel_result);
$query=$sel_r[query];
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
  {
   $gemarkung=$r[gemkg_id];
   $flur=vor_null($r[flur_id],3);
   $pgquery="UPDATE fd_fluren set vormi='1' where gemkg='$gemarkung' AND flur='$flur'";
   $pgresult = $dbqueryp($connectp,$pgquery);
   }



$fselekt=505;
$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
$sel_result=mysqli_query($sel_query);
$sel_r=mysqli_fetch_array($sel_result);
$query=$sel_r[query];
$result=mysqli_query($query);
while($r=mysqli_fetch_array($result))
  {
   $gemarkung=$r[gemkg_id];
   $flur=vor_null($r[flur_id],3);
   $pgquery="UPDATE fd_fluren set risse='1' where gemkg='$gemarkung' AND flur='$flur'";
   $pgresult = $dbqueryp($connectp,$pgquery);
   }



} #Ende der Aktualisierung

$query="select sel_id,wert,aktualisierung from selekt";
$result=mysqli_query($db_link,$query);
while($r=mysqli_fetch_array($result))
  {
   $index=$r["sel_id"];
   $werte[$index]=$r["wert"];
   $aktualitaet=$r["aktualisierung"];
   }

echo "<table>
<tr>
<td style=\"font-family:Arial; font-size: 24pt; font-weight: bold\">Statistik der Flurdatenbank (",$fgesamt," Fluren)</td>
</tr>
<tr>
<td style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">Stand:", $aktualitaet,"&nbsp;&nbsp;&nbsp;
 <a href=\"#\"> Aktualisieren</a></td>
</tr>
</table></div>";

echo "<div class=\"ausgabe_bereich\">";


echo "<table style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">
<tr>
<td valign=\"top\"><table style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">
<tr>
<td colspan=\"2\"><b>Bodenordnungsverfahren</b></td></tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=20\">BOV-Fluren gesamt:</a></small></td>
<td align=\"right\">$werte[20]</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=21\">Fluren in laufenden<br>Verfahren:</a></small></td>
<td align=\"right\">$werte[21]</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=22\">Fluren aus abgeschlossenen<br>Verfahren:</a></small></td>
<td align=\"right\">$werte[22]</td>
</tr>
<tr>
<td colspan=\"2\"><hr></td></tr>
<td colspan=\"2\"><b>Komplexe Berechnungen</b></td></tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=60\">noch m&ouml;glich:</a></small></td>
<td align=\"right\">$werte[60]</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=61\">abgeschlossen:</a></small></td>
<td align=\"right\">$werte[61]</td>
</tr>
<tr>
<td colspan=\"2\"><hr></td></tr>
<td colspan=\"2\"><b>&Uuml;berarbeitung von<br>Stra&szlig;en/Hausnummern</b></td></tr>
<tr><td><small>Fluren mit Geb&auml;udebestand:</small></td>
<td align=\"right\">";
$gebflur=$fgesamt-$werte[9];
echo $gebflur,"</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=0\">keine Aktion:</a></small></td>
<td align=\"right\">$werte[0]</td>
</tr>

<tr><td><small><a href=\"xflur_selekt2.php?fselekt=1\">Karten beim Amt:</a></small></td>
<td align=\"right\">$werte[1]</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=3\">noch nicht in der ALK</a></small></td>
<td align=\"right\">$werte[3]</td>
</tr>
<tr><td><small><a href=\"xflur_selekt2.php?fselekt=5\">noch nicht im ALB</a></small></td>
<td align=\"right\">$werte[5]</td>
</tr>
<tr><td><small>abgeschlossen</small></td>
<td align=\"right\">$werte[4]</td>
</tr>
<td colspan=\"2\"><hr></td></tr>
<tr>
<td colspan=\"2\"><b>Digitales Rissarchiv</b></td>
</tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=500\">keine Aktion</a></small></td>
<td align=\"right\"><b>$werte[500]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=506\">georeferenziert</a></small></td>
<td align=\"right\"><b>$werte[506]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=507\">abgeschlossen</a> <a href=\"flur_statistik_map.php?rechts=4550000&hoch=5922000&range=65000&name=Rissarchiv komplett&layer=Rissarchiv\" target=\"_blank\">&nbsp;&nbsp;<img src=\"images/buttons/stat_karte.png\" width=30></a></small></td>
<td align=\"right\"><b>$werte[507]</b></td></tr>
</table></td>
<td>&nbsp;</td>
<td valign=\"top\">
<table style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">";

echo "<tr>
<td colspan=\"2\"><b>Altgeb&auml;udeerfassung</b></td>
</tr>
<tr>
<td valign=\"top\"><small>Fluren mit Geb&auml;udebestand:</small></td>
<td align=\"right\"><b>$gebflur</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=33\">keine Aktion</a></small></td>
<td align=\"right\"><b>$werte[33]</b></td></tr>

<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=37\">noch nicht in der ALK</a></small></td>
<td align=\"right\"><b>$werte[37]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=36\">abgeschlossen</a></small></td>
<td align=\"right\"><b>$werte[36]</b></td></tr>
<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td colspan=\"2\"><b>Geb&auml;ude ab 1992</b></td>
</tr>
<tr>
<td valign=\"top\"><small>Fluren mit Geb&auml;udebestand:</small></td>
<td align=\"right\"><b>$gebflur</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=44\">keine Aktion:</a></small></td>";
echo "<td align=\"right\"><b>$werte[44]</b></td></tr>

<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=42\">Aufforderungen<br>verschickt</a></small></td>
<td align=\"right\"><b>$werte[42]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"flur_selekt2.php?fselekt=43\">Einmessungen abgeschlossen</a><a href=\"flur_statistik_map.php?rechts=4550000&hoch=5922000&range=65000&name=Gebäudeeinmessungen abgeschlossen&layer=Geb.-Einm.\" target=\"_blank\">&nbsp;&nbsp;<img src=\"images/buttons/stat_karte.png\" width=30></a></small></td>
<td align=\"right\"><b>$werte[43]</b></td></tr>
";


echo "<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td colspan=\"2\"><b>Bodensch&auml;tzung</b></td>
</tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=70\">Bodensch&auml;tzung existiert:</a></small></td>
<td align=\"right\"><b>$werte[70]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=71\">in ALK eingearbeitet:</a><a href=\"flur_statistik_map.php?rechts=4550000&hoch=5922000&range=65000&name=Bodenschätzung eingearbeitet&layer=Bodenschätzung\" target=\"_blank\">&nbsp;&nbsp;<img src=\"images/buttons/stat_karte.png\" width=30></a></small></td>
<td align=\"right\"><b>$werte[71]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=74\">noch nicht eingearbeitet:</a></small></td>
<td align=\"right\"><b>$werte[74]</b></td></tr>";
echo "<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=75\">Nachschätzung existiert:</a></small></td>
<td align=\"right\"><b>$werte[75]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=76\">noch nicht eingearbeitet</a></small></td>
<td align=\"right\"><b>$werte[76]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=77\">abgeschlossen</a></small></td>
<td align=\"right\"><b>$werte[77]</b></td></tr>";
echo "</table></td>
<td>&nbsp;</td>
<td valign=\"top\"><table style=\"font-family:Arial; font-size: 12pt; font-weight: normal\">";


echo "<tr>
<td colspan=\"2\"><b>ALKIS Vormigration<br>Feldvergleich Geb&auml;ude<br>und Einarbeitung in ALK</b></td>
</tr>
<tr>
<td valign=\"top\"><small>Fluren mit Geb&auml;udebestand:</small></td>
<td align=\"right\"><b>$gebflur</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=53\">keine Aktion:</a></small></td>";
echo "<td align=\"right\"><b>$werte[53]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=51\">abgeschlossen</a></small></td>
<td align=\"right\"><b>$werte[51]</b></td></tr>

<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td colspan=\"2\"><b>ALKIS Vormigration<br>(1) Vergleich ALB-ALK</b></td>
</tr>


<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=57\">bereit zum Abgleich</a></small></td>
<td align=\"right\"><b>$werte[57]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=58\">&Uuml;berhaken entfernen</a></small></td>
<td align=\"right\"><b>$werte[58]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=56\">abgeschlossen<br>wartet auf Aktualisierung</a></small></td>
<td align=\"right\"><b>$werte[56]</b></td></tr>
<tr><td colspan=\"2\"><hr></td></tr>

<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=96\">Feldvergleich Nutzung</a></small></td>
<td align=\"right\"><b>$werte[96]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=95\">Flächendifferenzen</a></small></td>
<td align=\"right\"><b>$werte[95]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=98\">Berechnungsanträge</a></small></td>
<td align=\"right\"><b>$werte[98]</b></td></tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=97\">Digitalisierungsanträge</a></small></td>
<td align=\"right\"><b>$werte[97]</b></td></tr>
<tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=99\">bereit für Stufe 2:</a> <a href=\"flur_statistik_map.php?rechts=4550000&hoch=5922000&range=65000&name=ALK-ALB Abgleich abgeschlossen&layer=Abgleich-Ok\" target=\"_blank\">&nbsp;&nbsp;<img src=\"images/buttons/stat_karte.png\" width=30></a></small></td>
<td align=\"right\"><b>$werte[99]</b></td></tr>
<tr><td colspan=\"2\"><hr></td></tr>
<td colspan=\"2\"><b>(2) Vormigration</b></td>
</tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=105\">abgeschlossen:</a></a> <a href=\"flur_statistik_map.php?rechts=4550000&hoch=5922000&range=65000&name=Vormigration abgeschlossen&layer=Vormigration\" target=\"_blank\">&nbsp;&nbsp;<img src=\"images/buttons/stat_karte.png\" width=30></a></small></td>
<td align=\"right\"><b>$werte[105]</b></td></tr>

<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=106\">Stufe 2b abgeschlossen:</a></small></td>
<td align=\"right\"><b>$werte[106]</b></td></tr>
<tr><td colspan=\"2\"><hr></td></tr>
<tr>
<td colspan=\"2\"><b>(3) Testmigration</b></td>
</tr>
<tr>
<td valign=\"top\"><small><a href=\"xflur_selekt2.php?fselekt=104\">abgeschlossen:</a></small></td>
<td align=\"right\"><b>$werte[104]</b></td></tr>
<tr>
<td colspan=\"2\"><hr></td>
</tr>
<tr>
<td></td>
</tr>



</table></td></tr></table></div>";


nav_flur("alkgrund");
bottom();
?>