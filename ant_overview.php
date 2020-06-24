<?php
include ("connect.php");
include ("function.php");

head_ant();
nav_ant();

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM antrag WHERE id=$id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
if($r[id]>0)
{
echo "<br>";
nav_aendern_o($id);
echo "<div align=\"center\"><table width=\"90%\" border=\"1\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<tr align=\"center\" bgcolor=\"#F08EBF\">
 <td colspan=\"2\">Allgemeine Angaben</td>
 <td >Durchlauf</td>
 <td>Datum</td>
 <td> Mitarbeiter</td>
 <td> OK ?</td>
 </tr>
<tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Antrag:</td>
 <td>$r[id]</td>

 <td bgcolor=\"#F08EBF\">&nbsp;Antragseingang&nbsp;</td>
 <td>&nbsp;$r[eing_datum]&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>";
 echo "</tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;VmSt.:</td>
 <td>";
 $query10="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result10=mysql_query($query10,$db_link);
     $r10=mysql_fetch_array($result10);
     echo"$r10[vermst]
 </td>
 <td bgcolor=\"#F08EBF\">&nbsp;Vorbereitung&nbsp;</td>
 <td>&nbsp;$r[vorb_datum]&nbsp;</td>
  <td>";
     if($r[vorb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[vorb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"&nbsp;$r1[name]&nbsp;";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[vorb_ja_nein]==0)echo "nein";
  if($r[vorb_ja_nein]==1)echo "ja";
  echo"</td>
  </tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Gemarkung:&nbsp;</td>
 <td>";
 $query11="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id]";
     $result11=mysql_query($query11,$db_link);
     $r11=mysql_fetch_array($result11);
     echo"$r11[gemarkung]
 </td>
 <td bgcolor=\"#F08EBF\">&nbsp;&nbsp;Messeingang&nbsp;</td>
 <td>&nbsp;$r[me_datum]&nbsp;</td>
  <td>";
     if($r[me_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[me_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"$r1[name]";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[me_ja_nein]==0)echo "nein";
  if($r[me_ja_nein]==1)echo "ja";
echo"</td>
</tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Flur: </td>
 <td>$r[flur]</td>
 <td bgcolor=\"#F08EBF\">&nbsp;ALK&nbsp;</td>
 <td>&nbsp;$r[alk_datum]&nbsp;</td>
  <td>";
     if($r[alk_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[alk_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"&nbsp;$r1[name]&nbsp;";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[alk_ja_nein]==0)echo "nein";
  if($r[alk_ja_nein]==1)echo "ja";
  if($r[alk_ja_nein]==2)echo "keine ALK";
echo"</td>
</tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Flst.:&nbsp;</td>
 <td>$r[flst]</td>
 <td bgcolor=\"#F08EBF\">&nbsp;ALB</td>
 <td>&nbsp;$r[alb_datum]&nbsp;</td>
  <td>";
     if($r[alb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[alb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"&nbsp;$r1[name]&nbsp;";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[alb_ja_nein]==0)echo "nein";
  if($r[alb_ja_nein]==1)echo "ja";
  if($r[alb_ja_nein]==2)echo "kein ALB";
echo"</td>
</tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Verm.-art:&nbsp;</td>
 <td>";
$query12="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result12=mysql_query($query12,$db_link);
     $r12=mysql_fetch_array($result12);
     echo"$r12[vermart]
 </td>
 <td bgcolor=\"#F08EBF\">&nbsp;&Uuml;bernahme&nbsp;</td>
 <td>&nbsp;$r[ueb_datum]&nbsp;</td>
  <td>";
     if($r[ueb_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[ueb_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"&nbsp;$r1[name]&nbsp;";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[ueb_ja_nein]==0)echo "nein";
  if($r[ueb_ja_nein]==1)echo "ja";
  if($r[ueb_ja_nein]==2)echo "keine Rechnung";
echo"</td>
</tr>
 <tr>
 <td bgcolor=\"#F08EBF\">&nbsp;Aktenort:&nbsp;</td>
 <td>";
 $query13="SELECT * FROM aktort WHERE aktort_id=$r[aktort_id]";
     $result13=mysql_query($query13,$db_link);
     $r13=mysql_fetch_array($result13);
     echo"$r13[aktort]</td>
 <td bgcolor=\"#F08EBF\">&nbsp;Rechnungen&nbsp;</td>
 <td>&nbsp;$r[re_rech1]&nbsp;</td>
  <td>";
     if($r[re_mit_id]>0)
     {
     $query1="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[re_mit_id]";
     $result1=mysql_query($query1,$db_link);
     $r1=mysql_fetch_array($result1);
     echo"&nbsp;$r1[name]&nbsp;";
     }
     else
     {
     echo "&nbsp;nicht erfasst&nbsp;";
     }
echo " </td>
  <td>";
  if($r[re_ja_nein]==0)echo "nein";
  if($r[re_ja_nein]==1)echo "ja";
echo"</td>
</tr>
</table><br>
<input type=button value=\"Druckansicht\" onClick='window.open(\"ant_overview_print.php?id=$id\")'></div>";





}
else
{
echo "<h3>Die Antragsnummer --> ",$id," <-- ist (noch) nicht vergeben..</h3>";
error();
}
echo "<br><div align=\"center\">";
echo "<a href=\"ant_overview.php?id=$vorgaenger\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>&nbsp;&nbsp;
 <a href=\"ant_overview.php?id=$nachfolger\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a></a></a></div><br> <br> ";
nav_ant();
bottom();
?>