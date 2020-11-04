<?php
include ("connect.php");
include ("connect_geobasis.php");
include ("function.php");



$id=$_GET["id"];
$sortierfeld=$_GET["sort"];
$nachweis_id=$_GET["nachweis_id"];



head_flur();
nav_flur("kvwmap");
?>
<div align=center style="font-family:Arial; font-size: 12pt; font-weight: bold">
<h3>Log-Einträge für den Nachweis:</h3>
<?php


$flurid=$gemarkung.$flur;
$query="SELECT n.id as nachweis_id,n.flurid,n.stammnr,n.blattnummer,n.art,n.datum,nd.dokumentart_id,n.vermstelle,n.link_datei,n.format,v.id,v.name from  n_vermstelle as v,nachweisverwaltung.n_nachweise as n LEFT JOIN nachweisverwaltung.n_nachweise2dokumentarten as nd ON (n.id=nd.nachweis_id) WHERE n.id='$nachweis_id' AND CAST(n.vermstelle AS INTEGER)=v.id ORDER BY stammnr,blattnummer,art";


  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $nachweis[$count]=$r;
    }

for ($i=2;$i<=$count;$i++)
    {
     for ($j=$i;$j>=2;$j--)
         {
          if ($nachweis[$j][$sortierfeld] < $nachweis[$j-1][$sortierfeld])
              {
                $tausch[1]=$nachweis[$j];
                $nachweis[$j]=$nachweis[$j-1];
                $nachweis[$j-1]=$tausch[1];

               }
          }
     }



echo "<table>
      <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
      <td width=\"40\">Nr.</td>
      <td width=\"50\">Blatt</td>
      <td width=\"70\">Flur</td>
      <td width=\"50\">Art</td>
      <td width=\"70\">Format</td>
      <td width=\"200\">Vermessungsstelle</td>
      <td>Datum</td>
      <td>Nachweis-ID</td></tr>";

$color="#FCFCFC";
for ($i=1;$i<=$count;$i++)
    {
     $nachweis_id_insert=$nachweis[$i]["nachweis_id"]+1;
     $nachweis_id_update=$nachweis[$i]["nachweis_id"];

     if ($nachweis[$i]["art"] == '100') $art="FFR";
     if ($nachweis[$i]["art"] == '010') $art="KVZ";
     if ($nachweis[$i]["art"] == '001') $art="GN";
     if ($nachweis[$i]["art"] == '111') 
         {
           $art2=$nachweis[$i]["dokumentart_id"];
                  if ($art2 == '124') $art= "Winkelbuch";
                  if ($art2 == '123') $art= "Polygonübersicht";
                  if ($art2 == '125') $art= "Liniennetzriss";
                  if ($art2 == '126') $art= "Anlage zum FFR";
                  if ($art2 == '127') $art= "Schlussvermessung Straße";
                  if ($art2 == '128') $art= "Schlussvermessung Bahn";
                  if ($art2 == '129') $art= "Schlussvermessung Wasser";
                  if ($art2 == '130') $art= "Werkvertrag Riss";
                  if ($art2 == '131') $art= "Grundstücksplan";
                  if ($art2 == '132') $art= "Lage- und Höhenplan";
                  if ($art2 == '133') $art= "Werkvertrag KVZ";
         }
  
    $stammnr=$nachweis[$i]["stammnr"];
    while (strlen($stammnr) < 8)
    {
      $stammnr="0".$stammnr;
    }
     $dname="/docs/".$nachweis[$i]['flurid']."/".$stammnr."/".$nachweis[$i]['link_datei']; 
     
         echo "<tr bgcolor=$color style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td><b>",$nachweis[$i]["stammnr"],"</b></td>
     <td>",$nachweis[$i]["blattnummer"],"</td>
     <td><small>",$nachweis[$i]["flurid"],"</td>
     <td><small>",$art,"</td>
     <td>",$nachweis[$i]["format"],"</td>
     <td>",$nachweis[$i]["name"],"</td>
     <td>",$nachweis[$i]["datum"],"</td>
     <td align=right>",$nachweis[$i]["nachweis_id"],"</td>
<td><a href=",$db_link," Target=\"about_blank\"><img src=\"images/buttons/dok.png\" width=20 border=0></a></td>
     </tr>
     </table>";
     }
echo "</table>";
echo "<br><br><hr>";

$logquery="SELECT * FROM n_update_log WHERE aktion='INSERT' AND nachweis_id = '$nachweis_id_insert'";
$logresult = $dbqueryp($connectp,$logquery);
  $logcount=0;

  while($log_r = $fetcharrayp($logresult))
    {
     $logcount++;
     
     $logs[$logcount]=$log_r;
    }

if ($logcount == 0)
    {
      echo "Zu diesem Nachweis wurden keine Einfüge-Logs registriert.<br><br>";
    }
    else
    {
     echo "<table><tr>
           <td width=300>Zeitpunkt</td>
           <td>Aktion</td>
           </tr>";
     for ($j=1;$j<=$logcount;$j++)
       {
         echo "<tr>
               <td>",substr($logs[$j]["aktualisiert"],0,19),"</td>
               <td>",$logs[$j]["aktion"],"</td>
               </tr><tr><td colspan=2><hr></td></tr>";
       }
     echo "</table>";
    }


$logquery="SELECT * FROM n_update_log WHERE nachweis_id = '$nachweis_id_update'";
$logresult = $dbqueryp($connectp,$logquery);
  $logcount=0;

  while($log_r = $fetcharrayp($logresult))
    {
     $logcount++;
     
     $logs[$logcount]=$log_r;
    }

if ($logcount == 0)
    {
      echo "Zu diesem Nachweis wurden keine Update-Logs registriert.<br><br>";
    }
    else
    {
     echo "<table><tr>
           <td width=300>Zeitpunkt</td>
           <td>Aktion</td>
           </tr><tr><td colspan=2><hr></td></tr>";
     for ($j=1;$j<=$logcount;$j++)
       {
         echo "<tr>
               <td>",substr($logs[$j]["aktualisiert"],0,19),"</td>
               <td>",$logs[$j]["aktion"],"</td>
               </tr>";
       }
     echo "</table>";
    }
echo "<br><br><hr>";


nav_flur("nachweise");
bottom();
?>