<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();
echo "<div align=\"center\">";
$vermst_id=$_POST["vermst_id"];
$zeit = time(); // Aktuelle Zeit in Sekunden
$datum = getdate($zeit);
$stat_datum=$datum[year]."-".$datum[mon]."-".$datum[mday];



$jahr = array("1993","1994","1995","1996","1997","1998","1999","2000","2001","2002","2003","2004","2005","2006","2007","2008","2009","2010","2011","2012","2013");

if($vermst_id>0)
{
 $query3="SELECT * FROM vermst WHERE vermst_id=$vermst_id";
 $result3=mysql_query($query3,$db_link);
 $r3=mysql_fetch_array($result3);

echo "Statistik der Antragsdatenbank, Stand: ",$stat_datum;
echo "<br>Vermessungsstelle: <h3>",$r3[vermst],"</h3><br>";
$query="SELECT * from antrag WHERE vermst_id=$vermst_id;";
}
else
{
echo "Statistik der Antragsdatenbank, Stand: ",$stat_datum;
echo "<br>Es werden alle Vermessungsstellen in die Auswertung mit einbezogen<br>";
$query="SELECT * from antrag;";
}
$i=0;
echo "<font face=\"Arial\"><table border=\"1\">
<tr align=\"center\">
<td rowspan=\"2\" bgcolor=\"#EFA036\">Jahr</td>
<td colspan=\"6\" bgcolor=\"#66FB46\">Anzahl der Antr&auml;ge</td>
<td colspan=\"16\" bgcolor=\"#6C99D5\">Art der Vermessung</td></tr>
<tr align=\"center\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#66FB46\">Antr.</td>
<td bgcolor=\"#66FB46\">Vorb.</td>
<td bgcolor=\"#66FB46\">ME</td>
<td bgcolor=\"#66FB46\">&Uuml;bern.</td>
<td bgcolor=\"#66FB46\">ALB</td>
<td bgcolor=\"#66FB46\">ALK</td>
<td bgcolor=\"#6C99D5\">Zerl.</td>
<td bgcolor=\"#6C99D5\">Grenzf.</td>
<td bgcolor=\"#6C99D5\">Geb.-<br>Einm.</td>
<td bgcolor=\"#6C99D5\">Grenz-<br>anz.</td>
<td bgcolor=\"#6C99D5\">Ver-<br>schm.</td>
<td bgcolor=\"#6C99D5\">Sond.</td>
<td bgcolor=\"#6C99D5\">Lagepl.</td>
<td bgcolor=\"#6C99D5\">Kat.-<br>Ber.</td>
<td bgcolor=\"#6C99D5\">Umfl.</td>
<td bgcolor=\"#6C99D5\">WV</td>
<td bgcolor=\"#6C99D5\">BOV</td>
<td bgcolor=\"#6C99D5\">Techn.-<br>Verm.</td>
<td bgcolor=\"#6C99D5\">Lage-<br>netze</td>
<td bgcolor=\"#6C99D5\">Nutz.-<br>art</td>
<td bgcolor=\"#6C99D5\">Schluss-<br>verm.</td>
<td bgcolor=\"#6C99D5\">freiw.<br>Landt.</td>
</tr>";
for($i=0;$i<=20;$i++)
 {
 $ant=0;
 $vorb=0;
 $me=0;
 $ueb=0;
 $alk=0;
 $alb=0;
 $zerl=0;
 $gf=0;
 $ge=0;
 $gaz=0;
 $sond=0;
 $wv=0;
 $bov=0;
 $tech=0;
 $beri=0;
 $lage=0;
 $versch=0;
 $umfl=0;
 $techverm=0;
 $lagenetze=0;
 $nutzungsart=0;
 $schlussverm=0;
 $freiwlt=0;

  $result=mysql_query($query,$db_link);
  while($r=mysql_fetch_array($result))
  {
  $von=$jahr[$i]."-01-01";
  $bis=$jahr[$i]."-12-31";
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis)$ant++;
  if($r[vorb_datum]>=$von AND $r[vorb_datum]<=$bis)$vorb++;
  if($r[me_datum]>=$von AND $r[me_datum]<=$bis)$me++;
  if($r[ueb_datum]>=$von AND $r[ueb_datum]<=$bis)$ueb++;
  if($r[alk_datum]>=$von AND $r[alk_datum]<=$bis)$alk++;
  if($r[alb_datum]>=$von AND $r[alb_datum]<=$bis)$alb++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==1)$zerl++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==2)$gf++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==3)$ge++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==8)$gaz++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==6)$sond++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==5)$wv++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==12)$beri++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==11)$lage++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==4)$versch++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==13)$techverm++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==10)$umfl++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==11)$lagenetze++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==14)$nutzungsart++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==15)$schlussverm++;
  if($r[eing_datum]>=$von AND $r[eing_datum]<=$bis AND $r[vermart_id]==16)$freiwlt++;
  }

  echo "<tr align=\"center\" style=\"font-family:Arial; font-size: 9pt; font-weight: bold\">
  <td bgcolor=\"#EFA036\">&nbsp;",$jahr[$i],"&nbsp;</td>";
  echo "<td bgcolor=\"#66FB46\">",$ant,"</td>";
  echo "<td bgcolor=\"#66FB46\">",$vorb,"</td>";
  echo "<td bgcolor=\"#66FB46\">",$me,"</td>";
  echo "<td bgcolor=\"#66FB46\">",$ueb,"</td>";
  echo "<td bgcolor=\"#66FB46\">",$alb,"</td>";
  echo "<td bgcolor=\"#66FB46\">",$alk,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$zerl,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$gf,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$ge,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$gaz,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$versch,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$sond,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$lage,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$beri,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$umfl,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$wv,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$bov,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$techverm,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$lagenetze,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$nutzungsart,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$schlussverm,"</td>";
  echo "<td bgcolor=\"#6C99D5\">",$freiwlt,"</td>";
  echo "</tr>";
  }
echo "</font></table></div>";

nav_ant();
bottom();
?>