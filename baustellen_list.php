<?php

include("connect.php");
include("function.php");

$datum = getdate(time());
$year=$datum[year];
$month=$datum[mon];
$day=$datum[mday];
$hour=$datum[hours];
$minute=$datum[minutes];
$second=$datum[seconds];
if (strlen($month) == 1) $month='0'.$month;
if (strlen($day) == 1) $day='0'.$day;
if (strlen($hour) == 1) $hour='0'.$hour;
if (strlen($minute) == 1) $minute='0'.$minute;
if (strlen($second) == 1) $second='0'.$second;
$currenttime=$year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second;
echo "<body bgcolor=\"#000000\" text=\"#FCFDBF\">
<div align=\"center\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">
Aktuelle Baustellen<br><br></div>";
$query="SELECT * from baustellen WHERE baust_end ='nein' ORDER by baust_start DESC;";
$result=mysql_query($query);
echo "<table>
<tr text=\"#FFFFFF\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">
<td width=\"175\">Bearbeiter</td>
<td width=\"250\">Gemarkung</td>
<td width=\"150\">Flur/Flst.</td>
<td width=\"150\">Art</td>
<td width=\"200\">Start</td>
</tr>";
while($r=mysql_fetch_array($result))
  {
  echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td>";
     $query5="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mitarb_id]";
     $result5=mysql_query($query5);
     $r5=mysql_fetch_array($result5);
     echo"$r5[name]
  </td>
  <td>";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gem_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]&nbsp;($r[gem_id])
  </td>
  <td>$r[flur]</td>
  <td>";
   $query4="SELECT * FROM baustellenart WHERE id='$r[baust_art]'";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[art]
  </td>
  <td>$r[baust_start]</td>
  <td>
  <a href=\"baustelle_abschl_warn.php?id=$r[id]\"><img src=\"images/traffic.jpg\" width=\"25\" alt=\"Baustelle abschliessen\" border=\"0\"></a>
  </td>
  </tr>";

  }
?>
  </table>

<form action="baustellen_list.php" method="POST" target="">
<input type="Submit" name="" value="Aktualisieren">
</form>

<?php
bottom();
?>