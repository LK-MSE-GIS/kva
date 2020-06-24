<?php
include ("connect.php");
include ("function.php");

$id=$_GET["id"];

$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);

$query="SELECT * FROM antrag_extra WHERE id=$id";
$xresult=mysql_query($query,$db_link);
$xr=mysql_fetch_array($xresult);

$zeit = time(); // Aktuelle Zeit in Sekunden
$datum = getdate($zeit);
$eintrag=$datum[year]."-".$datum[mon]."-".$datum[mday];

echo "<div align=\"left\" style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">Landkreis Müritz<br>Kataster- und Vermessungsamt<br>Datum:&nbsp;$eintrag<br><br></div>
<div align=\"left\" style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">Antrags&uuml;bersicht<br><br></div>


<table border=\"0\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr align=\"left\">
 <td width=\"200\">Antrag</td>
 <td  style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">$r[number]/",substr($r[year],2,2),"</td>
 </tr>
 <tr>
 <td>VmSt.:</td>
 <td style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">";
 $query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysql_query($query10,$db_link);
     $r10=mysql_fetch_array($result10);
     echo"$r10[vermst]
 </td>
 </tr>
 <tr>
 <td width=\"200\">Gemarkung:</td>
 <td style=\"font-family:Arial; font-size: 18pt; font-weight: bold\">";
 $query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
     echo"$r11[gemarkung]
 </td>
 </tr>
 <tr>
<td>Verm.-art:</td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysql_query($query12,$db_link);
     $r12=mysql_fetch_array($result12);
     echo"$r12[vermart]
 </td>
 </tr>
 <tr>
 <td>Flur: </td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">$r[flur_1]</td>
 </tr>
 <tr>
 <td>Flurst&uuml;ck(e): </td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">$r[flst_1]</td>
 </tr>
  <tr>
 <td>Sachverhalt: </td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">$r[sv]</td>
 </tr>
   <tr>
 <td>Aktenzeichen (Vermst.): </td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">$r[az]</td>
 </tr>
   <tr>
 <td>Akteneingang: </td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">$r[eing_datum]</td>
 </tr>
 <tr>
<td>Aktenort:</td>
 <td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">";
 $query13="SELECT * FROM aktort WHERE aktort_id=$r[aktort_id]";
     $result13=mysql_query($query13,$db_link);
     $r13=mysql_fetch_array($result13);
     echo"$r13[aktort]</td>
 </tr>
 </table>
 <br>
 <div  style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">Durchlauf der Akte:</div>
 <br>
 <table  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <tr></tr>
 <td width=\"150\">Abteilung</td>
 <td width=\"100\">Datum</td>
 <td width=\"200\"> Mitarbeiter</td>
 <td width=\"30\"> OK ?</td>
 </tr>
<tr>
  <td>Vorbereitung</td>
 <td>$r[vorb_datum]</td>
  <td>";
     if($xr[vorb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[vorb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[vorb_ja_nein]==0)echo "nein";
  if($xr[vorb_ja_nein]==1)echo "ja";
  echo"</td>
  </tr>
 <tr>
 <td>Messeingang&nbsp;</td>
 <td>$r[me_datum]</td>
  <td>";
     if($xr[me_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[me_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[me_ja_nein]==0)echo "nein";
  if($xr[me_ja_nein]==1)echo "ja";
echo"</td>
</tr>
 <tr>
 <td>ALK</td>
 <td>$r[alk_datum]</td>
  <td>";
     if($xr[alk_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[alk_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[alk_ja_nein]==0)echo "nein";
  if($xr[alk_ja_nein]==1)echo "ja";
  if($xr[alk_ja_nein]==2)echo "keine ALK";
echo"</td>
</tr>
 <tr>
 <td>ALB</td>
 <td>$r[alb_datum]</td>
  <td>";
     if($xr[alb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[alb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[alb_ja_nein]==0)echo "nein";
  if($xr[alb_ja_nein]==1)echo "ja";
  if($xr[alb_ja_nein]==2)echo "kein ALB";
echo"</td>
</tr>
 <tr>
 <td>&Uuml;bernahme</td>
 <td>$r[ueb_datum]</td>
  <td>";
     if($xr[ueb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[ueb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[ueb_ja_nein]==0)echo "nein";
  if($xr[ueb_ja_nein]==1)echo "ja";
  if($xr[ueb_ja_nein]==2)echo "keine Rechnung";
echo"</td>
</tr>
 <tr>
<td>Rechnungen</td>
 <td>$xr[re_rech1]</td>
  <td>";
     if($xr[re_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$xr[re_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "nicht erfasst";
     }
echo " </td>
  <td>";
  if($xr[re_ja_nein]==0)echo "nein";
  if($xr[re_ja_nein]==1)echo "ja";
echo"</td>
</tr>
</table><br></div>
<div  style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">Rechnungen:</div>
 <br>
<div  style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">Vorbereitung</div>
 <br> ";
$summe=0;
if ($xr[vorb_betrag]>0)
  {
  echo "<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <tr>
  <td width=\"120\">Datum</td>
  <td width=\"100\">Kassenzeichen</td>
  <td width=\"70\" align=\"right\">Betrag</td>
  </tr>
  <tr>
  <td>$xr[vorb_re_datum]</td>
  <td>$xr[vorb_kassz]</td>
  <td align=\"right\">$xr[vorb_betrag]</td>
  </tr>
  </table><br>";
  $summe=$summe+$xr[vorb_betrag];
  }
  else echo "<br><div  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">Keine Rechnung gestellt</div><br> ";

  echo "<div  style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">&Uuml;bernahme</div>
 <br> ";

if ($xr[re_betrag1]>0)
  {
  echo "<table style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <tr>
  <td width=\"120\">Datum</td>
  <td width=\"100\">Kassenzeichen</td>
  <td width=\"70\" align=\"right\">Betrag</td>
  </tr>
  <tr>
  <td>$xr[re_rech1]</td>
  <td>$xr[re_kz1]</td>
  <td align=\"right\">$xr[re_betrag1]</td>
  </tr>";
  $summe=$summe+$xr[re_betrag1];
  }
  else echo "<br><div  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">Keine Rechnung gestellt</div><br> ";
if ($xr[re_betrag2]>0)
  {
  echo "
  <tr>
  <td>$xr[re_rech2]</td>
  <td>$xr[re_kz2]</td>
  <td align=\"right\">$xr[re_betrag2]</td>
  </tr>";
  $summe=$summe+$xr[re_betrag2];
  }
if ($xr[re_betrag3]>0)
  {
  echo "
  <td>$xr[re_rech3]</td>
  <td>$xr[re_kz3]</td>
  <td align=\"right\">$xr[re_betrag3]</td>
  </tr>";
  $summe=$summe+$xr[re_betrag3];
  }
if ($xr[re_betrag4]>0)
  {
  echo "
  <tr>
  <td>$xr[re_rech4]</td>
  <td>$xr[re_kz4]</td>
  <td align=\"right\">$xr[re_betrag4]</td>
  </tr>";
  $summe=$summe+$xr[re_betrag4];
  }
  if ($xr[re_betrag5]>0)
  {
  echo "
  <tr>
  <td>$xr[re_rech5]</td>
  <td>$xr[re_kz5]</td>
  <td align=\"right\">$xr[re_betrag5]</td>
  </tr>";
  $summe=$summe+$xr[re_betrag5];
  }
  if ($summe>0)
    {
    $resultat=sprintf("%5.2f",$summe);
   echo"<tr>
   <td colspan=\"3\"><hr></td></tr>
   <tr>
  <td colspan=\"2\">Gesamtsumme aller Rechnungen:</td>
  <td align=\"right\">$resultat</td>
  </tr>";
  }
?>