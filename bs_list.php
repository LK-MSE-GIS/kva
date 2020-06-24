<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("baust_function.php");
$status=$_GET["status"];

head_baust();
nav_baust();

bs_navi();
?>
<body>

<font face="Arial">


<div align="center">


<?php



if ($status == '0')
 {
   echo "<h3> Erfassung der Bodenschätzung (keine Aktion)</h3>";
   $qtext="keine Aktion";
 }
if ($status == '1')
 {
   echo "<h3> Erfassung der Bodenschätzung (bei Verm.-Stelle)</h3>";
   $qtext="bei Vermessungsstelle";
 }
if ($status == '2')
 {
   echo "<h3> Erfassung der Bodenschätzung (Eingangsprüfung)</h3>";
   $qtext="Eingangsprüfung";
 }
if ($status == '3')
 {
   echo "<h3> Erfassung der Bodenschätzung <br>(in ALK übernommen, ohne Nachschätzung und 
Grablöcher)</h3>";
   $qtext="in ALK ohne NS und GL";
 }
if ($status == '4')
 {
  echo "<h3> Erfassung der Bodenschätzung (vollständig in ALK)</h3>";
  $qtext="in ALk übernommen vollständig";
 }

  $query="SELECT oid as id,box(the_geom) as box,bezeichnung,erstsch,nachsch,status from fd_bs where status='$qtext' ORDER BY bezeichnung;";
  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $bs[$count]=$r;
    }

   echo "$count Fluren<br><br>";
?>

<table>
<tr>
<td width="150">Bezeichnung</td>
<td width="150">Erstschätzung</td>
<td width="150">Nachschätzung</td>
<td width="200">Status</td>
</tr>


<tr><td colspan="6"><hr></td></tr>


<?php
  
for ($i=1;$i<=$count;$i++)
    {
  $id=$bs[$i][id];
  $boxstring=$bs[$i][box];
  $klammern=array("(",")");
  $boxstring=str_replace($klammern,"",$boxstring);
  $koordinaten=explode(",",$boxstring);
  $rechts_range=$koordinaten[0]-$koordinaten[2];
  $rechts=$koordinaten[2]+($rechts_range/2);
  $hoch_range=$koordinaten[1]-$koordinaten[3];
  $hoch=$koordinaten[3]+($hoch_range/2);
  $range=$hoch_range;
  if ($rechts_range > $hoch_range) $range=$rechts_range;
  $range=$range+4000;
  $name=$bs[$i][bezeichnung];
     $link=URL."kva/"."wv_map.php?rechts=$rechts&hoch=$hoch&range=$range&name=$name&kopf=0";

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$bs[$i][bezeichnung],"</td>
     <td>",$bs[$i][erstsch],"</td>
     <td>",$bs[$i][nachsch],"</td>
     <td>",$bs[$i][status],"</td>";     
     if ((strpos($abteilung,"wv") > -1) OR (strpos($abteilung,"adm") > -1)) echo "<td><a href=\"bs_edit.php?id=$id\">Status ändern</a>
     </td></tr>";
    }

?>

</table>
</body>    