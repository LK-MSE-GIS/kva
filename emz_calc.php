<?php
include ("connect_pgsql.php");
$flst=$_GET["flst"];
$name=$_GET["name"];
$flur=$_GET["flur"];
$nummer=$_GET["nummer"];

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
      <td align=left width=150><img src="images/logo_msp.gif" width="100" height="120" border="0" alt=""></td>
      <td width=200>Landkreis Mecklenburgische Seenplatte<br>Der Landrat<br><small>Kataster- und Vermessungsamt<br>Platanenstraße 43<br>17033 Neubrandenburg<br>Telefon: 0395-570872488</small></td>
<td width=200 align=right valign=top><?php echo $print_datum; ?></td>
    </tr>
   </table><br>

<div align="center">

<h2>Berechnung der Bodenwertzahlen</h2>

<?php




  $query="select DISTINCT intersection(o.the_geom,f.the_geom) AS intersection_geom,round(area(intersection(o.the_geom,f.the_geom))) as flaeche,substring(t.label from 18 for 3) AS wert,t.label FROM alkobj_e_fla as o, flurstuecke_small as f,alkobj_t_pkt as t WHERE o.the_geom && f.the_geom AND f.geographicidentifier='$flst' AND o.objart='222' AND area(intersection(o.the_geom,f.the_geom))>0 AND o.objnr=t.objnr";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $emz[$count]=$r;
    }

echo "<br><u>Flurstück</u><br>Gemarkung: $name<br>Flur: $flur<br>Flurstück: $nummer<br><br>"; 

if ($count > 0)
  {

echo "<h3>Schätzungsabschnitte Ackerland</h3><br><table>
<tr>
<td width=\"250\">Abschnitt</td>
<td width=\"150\" align=right>Fläche in m²</td>
<td width=\"200\" align=right>Ackerzahl</td>
<td width=\"180\" align=right>Ertragsmesszahl</td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>";


$color="#FCFCFC"; 
$gesamt_flaeche=0;
$gesamt_emz=0; 
for ($i=1;$i<=$count;$i++)
    {
      $color=changecolor($color);
     $gesamt_flaeche=$gesamt_flaeche+$emz[$i][flaeche];
     $gesamt_emz=$gesamt_emz+round(($emz[$i][flaeche]/100)*$emz[$i][wert]);

     echo "<tr bgcolor=$color style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",substr($emz[$i][label],4,20),"<br>";
    $bodenart=substr($emz[$i][label],4,2);
    switch ($bodenart)
      {
        case "SL": echo "(stark lehmiger Sand)"; break;
        case "S ": echo "(Sand)"; break;
        case "Sl": echo "(anlehmiger Sand)"; break;
        case "lS": echo "(lehmiger Sand)"; break;
        case "sL": echo "(sandiger Lehm)"; break;
        case "L ": echo "(Lehm)"; break;
        case "LT": echo "(schwerer Lehm)"; break;
        case "T ": echo "(Ton)"; break;
        case "Mo": echo "(Moor)"; break;
      }
     echo "</td>
     <td align=right>",$emz[$i][flaeche],"</td>
     <td align=right>",$emz[$i][wert],"</td>
     <td align=right>",round(($emz[$i][flaeche]/100)*$emz[$i][wert]),"</td>
    </tr>";
    }
echo "</table>";
$bwz=round($gesamt_emz/$gesamt_flaeche*100);
echo "<br><br>durchschnittliche Ackerzahl: $bwz";
}


  $query2="select DISTINCT intersection(o.the_geom,f.the_geom) AS intersection_geom,round(area(intersection(o.the_geom,f.the_geom))) as flaeche,substring(t.label from 18 for 3) AS wert,t.label FROM alkobj_e_fla as o, flurstuecke_small as f,alkobj_t_pkt as t WHERE o.the_geom && f.the_geom AND f.geographicidentifier='$flst' AND o.objart='223' AND area(intersection(o.the_geom,f.the_geom))>0 AND o.objnr=t.objnr";

  $result2 = $dbqueryp($connectp,$query2);
  $count2=0;

  while($r2 = $fetcharrayp($result2))
    {
     $count2++;
     $emz2[$count2]=$r2;
    }

echo "<br><br>"; 

if ($count2 > 0)
  {

echo "<h3>Schätzungsabschnitte Grünland</h3><br><table>
<tr>
<td width=\"250\">Abschnitt</td>
<td width=\"150\" align=right>Fläche in m²</td>
<td width=\"200\" align=right>Grünlandzahl</td>
<td width=\"180\" align=right>Ertragsmesszahl</td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>";


$color="#FCFCFC"; 
$gesamt_flaeche=0;
$gesamt_emz=0; 
for ($gr=1;$gr<=$count2;$gr++)
    {
      $color=changecolor($color);
     $gesamt_flaeche=$gesamt_flaeche+$emz2[$gr][flaeche];
     $gesamt_emz=$gesamt_emz+round(($emz2[$gr][flaeche]/100)*$emz2[$gr][wert]);

     echo "<tr bgcolor=$color style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",substr($emz2[$gr][label],4,20),"<br>";
    $bodenart=substr($emz2[$gr][label],4,2);
    switch ($bodenart)
      {
        case "SL": echo "(stark lehmiger Sand)"; break;
        case "S ": echo "(Sand)"; break;
        case "Sl": echo "(anlehmiger Sand)"; break;
        case "lS": echo "(lehmiger Sand)"; break;
        case "sL": echo "(sandiger Lehm)"; break;
        case "L ": echo "(Lehm)"; break;
        case "LT": echo "(schwerer Lehm)"; break;
        case "T ": echo "(Ton)"; break;
        case "Mo": echo "(Moor)"; break;
      }
     echo "</td>
     <td align=right>",$emz2[$gr][flaeche],"</td>
     <td align=right>",$emz2[$gr][wert],"</td>
     <td align=right>",round(($emz2[$gr][flaeche]/100)*$emz2[$gr][wert]),"</td>
    </tr>";
    }
echo "</table>";
$bwz=round($gesamt_emz/$gesamt_flaeche*100);
echo "<br><br>durchschnittliche Grünlandzahl: $bwz";
}


#pg_close($connectp);
?>
<br>
<br>
<br>
<div align=left>
<small><b>Zur Beachtung:</b><br>
Bei den in dieser Übersicht aufgelisteten Flächen handelt es sich um automatisiert
ermittelte Flächen, welche von Bodenschätzungsobjekten der Automatisierten Liegenschaftskarte (ALK) abgeleitet worden sind. Sie können von den aus dem Automatisierten Liegenschaftsbuch (ALB) stammenden Flächen abweichen und sind daher nur zum Zwecke der Ermittlung der Bodenwertzahlen zu verwenden. Für andere Zwecke (Wertermittlung usw.) ist auf die Daten des ALB zurückzugreifen.

  