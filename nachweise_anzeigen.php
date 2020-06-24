<?php
include ("connect_geobasis.php");
include ("connect.php");

$flur_id=$_GET["flur_id"];
$antrag_id=$_GET["antrag_id"];
$nachweis_id=$_GET["nachweis_id"];
$wohin=$_GET["wohin"];
$sort=$_GET["sort"];
$page=$_GET["page"];
$alt=$_GET["alt"];
$status=$_GET["status"];

$query="SELECT n.id as nachweis_id,n.flurid,n.rissnummer,n.blattnummer,nd.art,n.datum,n.vermstelle,n.gueltigkeit,n.link_datei,n.format,v.id,v.name from  nachweisverwaltung.n_vermstelle as v,nachweisverwaltung.n_nachweise as n LEFT JOIN nachweisverwaltung.n_dokumentarten as nd ON (n.art=nd.id) WHERE n.id='$nachweis_id' AND CAST(n.vermstelle AS INTEGER)=v.id";

$result = $dbqueryp($connectp,$query);
$r = $fetcharrayp($result);
    $art=$r[art];
    $rissnummer=$r[rissnummer];
	$laenge=strlen($r['link_datei']);
    $dateiname=substr($r['link_datei'],24,$laenge-24);
    
     $dname="docs/".$dateiname; 

     if ($wohin == "gemarkung") $destination="nachweise_gem.php?id=$flur_id&sort=rissnummer&highlight=$nachweis_id&sort=$sort#".$nachweis_id;

     if ($wohin == "flur") $destination="nachweise.php?id=$flur_id&sort=rissnummer&highlight=$nachweis_id&sort=$sort#".$nachweis_id;

     if ($wohin == "antrag") $destination="ant_nachweise.php?id=$antrag_id&page=$page&alt=$alt&status=$status";

echo "<table border=0><tr><td width=100 style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"><a href=$destination>Zurück</a></td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" width=100>Nummer:</td>
<td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\" width=200>$r[rissnummer]</td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" width=80>Blatt::</td>
<td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\" width=40>$r[blattnummer]</td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" width=300>Dokumentart: $art</td></tr>
<tr><td></td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">Verm.-Stelle:</td>
<td style=\"font-family:Arial; font-size: 14pt; font-weight: bold\"> $r[name] </td>
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">Datum:</td> 
<td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"> $r[datum] </td>
</tr>";
if ($r[gueltigkeit] == '0') echo "<tr><td colspan=8 style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">Dieses Dokument ist ungültig wegen eines übernommenen Flurneuordnungsverfahrens !</td></tr>";
echo "</table><br><br>";



echo "<a href=$dname> <b>hier</b> </a> klicken um den Nachweis anzzueigen</a><br><br>";
$vb=explode('.',$dname);
$vorschaubild=$vb[0].'_thumb.jpg';
echo '<img src="',$vorschaubild,'">';

?>

