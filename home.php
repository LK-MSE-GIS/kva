<?php
    include("connect.php");
    include("connect_geobasis.php");

    $datum = getdate(time());
    $year=$datum['year'];
    $month=$datum[mon];
    $day=$datum[mday];
    $wday=$datum[wday];
    if ($wday=='0') $wochentag="Sonntag";
    if ($wday=='1') $wochentag="Montag";
    if ($wday=='2') $wochentag="Dienstag";
    if ($wday=='3') $wochentag="Mittwoch";
    if ($wday=='4') $wochentag="Donnerstag";
    if ($wday=='5') $wochentag="Freitag";
    if ($wday=='6') $wochentag="Sonnabend";
    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$day.".".$month.".".$year;
    $bday_datum=$month."-".$day;
	
	$bild_id=$_GET["bild_id"];

  $query="SELECT count(kategorie_id) from q_notizen WHERE kategorie_id='1'";
  $result = $dbqueryp($connectp,$query);
  $r = $fetcharrayp($result);
  $qcount=$r[0];

  
  

?>
<html>
<head>
<title>Katasteramt</title>
<meta name="author" content="Thurm">
<meta name="generator" content="Ulli Meybohms HTML EDITOR">
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#FF0000" alink="#FF0000" vlink="#FF0000">

<font face="Arial">
<hr>
<table>
<tr>
<td align="left">&nbsp;<img src="images/mueritz.jpg" alt="" border="0" width="150">&nbsp;</td><td ><font size="+2"><?php echo $wochentag;  echo "<br> ",$print_datum; ?></font></td><td align="left">&nbsp;<img src="images/tiefwarensee.jpg" alt="" border="0" width="550"></td>
</tr>
</table>
<hr>
<table>
<tr>
<td width="300" valign="top">
<table border="0" bgcolor="#CCC280">
<tr>
<td><b>Wer hat heute Geburtstag?</b></td>
</tr>
<?php
$query="SELECT * from birthday where date='$bday_datum'";
$result=mysql_query($query,$db_link);
while($r=mysql_fetch_array($result))
  {
   $age=$year-$r[byear];
   if ($r[byear]=='') $age='??';
   echo "<tr><td>$r[name]($age)</td></tr>
   <tr><td><small>$r[whoisit]</td></tr>";
  }
?>
</table><br>
<?php
if ($qcount == 1) echo "<small><b>$qcount Fehlermeldung in kvwmap</small><br>";
if ($qcount > 1) echo "<small><b>$qcount Fehlermeldungen in kvwmap</small><br>";
if ($acount == 1) echo "<small><b>$acount Adressänderung in kvwmap</small><br>";
if ($acount > 1) echo "<small><b>$acount Adressänderungen in kvwmap</small><br>";

?>

<table border="0">
<tr><td><hr></td></tr>
<tr>
 <td width="300" align="left"><marquee>Neuigkeiten </marquee></td>
</tr>
<tr><td><hr></td></tr>

<tr><td>2013-11-06<br><b>ALKIS-Schulungsfeinkonzept</b><br><br><br>Von der Themengruppe Schulung wurde ein Konzept zum Inhanlt und zur Durchführung der Schulungen für die ALKIS-Komponenten erarbeitet.<br><br>Das Dokument ist im Bereich Vorschriften zu finden oder <a href="vorschriften/Schulungsfeinkonzept_20130909.pdf" target="_blank">hier</a>.</td></tr>



 </table>
 </div></td>
 <td>&nbsp;&nbsp;</td>

<?php
if ($bild_id < 1) $bild_id=mt_rand(1811,1815);

$query="SELECT id FROM pictures ORDER BY ID LIMIT 1";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
$first_pic=$r[id];

$query="SELECT id FROM pictures ORDER BY ID DESC LIMIT 1";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
$last_pic=$r[id];

$query="SELECT * from pictures where id='$bild_id'";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
  
?> 

<td width="700" valign="top">

 <font face="Arial"><font size="+2">

<?php 
$vorgaenger=$bild_id-1;
$nachfolger=$bild_id+1;
if ($bild_id > $first_pic) echo "<a href=\"home.php?bild_id=$vorgaenger\"><img src=\"images/buttons/nach_links.png\" width=20 border=0></a>";
echo " $r[head] ";
if ($bild_id < $last_pic) echo "<a href=\"home.php?bild_id=$nachfolger\"><img src=\"images/buttons/nach_rechts.png\" width=20 border=0></a>"; ?>
<br>
<font size="-1">
<?php echo $r[comment]; ?>



<table cellspacing="10">
<tr>
<td><img <?php echo "src=\"images/$bild_id.jpg\""; ?> width="700"  border="1"></td>
</tr>
<tr>
<td><font size="-1"><?php echo $r[titel]; ?></td>
</tr>
<tr>
<td><font size="-1">Foto: <?php echo $r[photographer]; ?></td>
</tr>

</table>

</body>
</html>
