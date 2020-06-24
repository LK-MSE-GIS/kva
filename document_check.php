<html>
<head>
<title>Dokumente überprüfen</title>
<meta name="author" content="thurm">
<meta name="generator" content="Ulli Meybohms HTML EDITOR">
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<div align="center" style="font-family:Arial; font-size: 12pt; font-weight: bold">
<h3>Überprüfung der Dokumente</h3>

<?php
include("connect_geobasis.php");
$gemkg=$_GET["gemkg"];
$maxgemkg=$gemkg."999";
$mingemkg=$gemkg."000";

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
$heute=$year.'-'.$month.'-'.$day;
$lfdmon=$year.'-'.$month;

echo "Stand:&nbsp;$day.$month.$year&nbsp;$hour:$minute:$second<br><div align=\"left\">";

  if (strlen($gemkg) > 0) $query="SELECT * FROM nachweisverwaltung.n_nachweise WHERE flurid >= '$mingemkg' AND flurid <= '$maxgemkg' ORDER BY flurid,rissnummer";
  else
  $query="SELECT * from nachweisverwaltung.n_nachweise ORDER BY flurid,rissnummer";

  $result = $dbqueryp($connectp,$query);
  $count=0;
  $richtig=0;
  $fehler=0;
  $geo_fehler=0;
  $last_flur=0;

echo "<table>
      <tr><td width=400>Dokument</td><td width=200>Fehler</td></tr>";

  while($r = $fetcharrayp($result))
    {
     $count++;
     $rissnummer=$r[rissnummer];
     while (strlen($rissnummer) <8) 
       {
         $rissnummer="0".$rissnummer;
       }
    
     $speicherort="/data/nachweise/".$r[flurid]."/".$rissnummer."/".$r[link_datei];
     
    if (file_exists($speicherort)) $richtig++;
      else
        {
         $fehler++;
         if ($last_flur != $r[flurid])
          {
           echo "<tr><td colspan=2><hr></td></tr><tr><td colspan=2>Flur: $r[flurid]</td></tr>";
           $last_flur=$r[flurid];
          }
         echo "<tr><td>$speicherort</td><td>Dokument fehlt</td></tr>";
        }   
    $gemkg=substr($r[flurid],0,6);
    $flur=substr($r[flurid],6,3);
    
    $flur_sql="SELECT o.the_geom,o.objnr FROM alkobj_e_fla as o, alknflur as f WHERE o.objnr=f.objnr AND f.gemkgschl='$gemkg' AND flur='$flur'"; 
    $flur_result = $dbqueryp($connectp,$flur_sql);
    $flur_r=$fetcharrayp($flur_result);
    if (strlen($flur_r[1]) > 0)
    {
    $flur_geometry=$flur_r[0];
    $doc_geometry=$r[the_geom];
    
    $check_sql="SELECT ST_Intersects('$doc_geometry','$flur_geometry')";
    $check_result = $dbqueryp($connectp,$check_sql);
    $check_r=$fetcharrayp($check_result);
    #echo $check_r[0],"<br>";
    if ($check_r[0] == "f") 
      {
         if ($last_flur != $r[flurid])
          {
           echo "<tr><td colspan=2><hr></td></tr><tr><td colspan=2>Flur: $r[flurid]</td></tr>";
           $last_flur=$r[flurid];
          }
         echo "<tr><td>$speicherort</td><td>falsch georeferenziert</td></tr>";
      $geo_fehler++;
      }  
    }
    else 
    {
         if ($last_flur != $r[flurid])
          {
           echo "<tr><td colspan=2><hr></td></tr><tr><td colspan=2>Flur: $r[flurid]</td></tr>";
           $last_flur=$r[flurid];
          }
         echo "<tr><td>$speicherort</td><td>Flur ????</td></tr>";
      $geo_fehler++;
     }
   }
echo "</table><br>";
echo "<br>insgesamt geprüft: $count<br>fehlende Dokumente: $fehler";
echo "<br>fehlerhafte Geometrie: $geo_fehler";
?>
</div>
</body>
</html>