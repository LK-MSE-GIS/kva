<?php
include ("connect.php");
include ("connect_geobasis.php");
include ("function.php");

function changecolor($farbe)
 {
  if ($farbe=="#D8DCDE") $farbe="#FCFCFC";
  else $farbe="#D8DCDE";
  return $farbe;
 }

$id=$_GET["id"];
$sortierfeld=$_GET["sort"];
$highlight=$_GET["highlight"];


head_flur();
nav_flur("kvwmap");
nachweis_kopf($id,$dbname);


$query="SELECT ID,gemkg_id,flur_id FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);


$gemarkung=$r[gemkg_id];
$flur=$r[flur_id];

while (strlen($flur) < 3)
  {
    $flur='0'.$flur;
  }

$flurid=$gemarkung.$flur;
$query="SELECT n.id as nachweis_id,n.flurid,n.rissnummer,n.blattnummer,n.art,n.datum,nd.dokumentart_id,n.vermstelle,n.gueltigkeit,n.link_datei,n.format,v.id,v.name from  nachweisverwaltung.n_vermstelle as v,nachweisverwaltung.n_nachweise as n LEFT JOIN nachweisverwaltung.n_nachweise2dokumentarten as nd ON (n.id=nd.nachweis_id) WHERE CAST(n.flurid AS CHAR VARYING) LIKE '$gemarkung%' AND CAST(n.vermstelle AS INTEGER)=v.id ORDER BY rissnummer,blattnummer,art";

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

echo "<font face=\"arial\"><h3> $count Nachweise gefunden</h3></font>";

echo "<table>
      <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
      <td width=\"40\"><a href=\"nachweise_gem.php?id=$id&sort=rissnummer\">Nr.</a></td>
      <td width=\"50\">Blatt</td>
      <td width=\"80\">Antrag</td>
      <td width=\"70\">Flur</td>
      <td width=\"50\"><a href=\"nachweise_gem.php?id=$id&sort=art\">Art</a></td>
      <td width=\"70\"><a href=\"nachweise_gem.php?id=$id&sort=format\">Format</a></td>
      <td width=\"200\"><a href=\"nachweise_gem.php?id=$id&sort=name\">Vermessungsstelle</a></td>
      <td><a href=\"nachweise_gem.php?id=$id&sort=datum\">Datum</a></td></tr>";

$color="#FCFCFC";
for ($i=1;$i<=$count;$i++)
    {
     $nachweis_id=$nachweis[$i][nachweis_id];
     if ($nachweis[$i][art] == '100') $art="FFR";
     if ($nachweis[$i][art] == '010') $art="KVZ";
     if ($nachweis[$i][art] == '001') $art="GN";
     if ($nachweis[$i][art] == '111') 
         {
           $art2=$nachweis[$i][dokumentart_id];
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
				  if ($art2 == '134') $art= "Flurkarte (hist.)";
         }
  
    $rissnummer=$nachweis[$i][rissnummer];
    while (strlen($rissnummer) < 8)
    {
      $rissnummer="0".$rissnummer;
    }
     $dname="/docs/".$nachweis[$i]['flurid']."/".$rissnummer."/".$nachweis[$i]['link_datei']; 
     if($nachweis[$i][$sortierfeld] != $nachweis[$i-1][$sortierfeld])
        {
        
        echo "<tr><td colspan=8><hr></td></tr>";
        }
   
         if ($nachweis_id == $highlight) $color = '#E269A9';
            else $color= '#FFFFFF';
         echo "<tr bgcolor=$color style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td><a name=\"$nachweis_id\"><b>",$nachweis[$i][rissnummer],"</b></a>";
	 if ($nachweis[$i][gueltigkeit] == '0') echo " **";
	 echo "</td>
     <td>",$nachweis[$i][blattnummer],"</td>
     <td>",get_antrag($nachweis[$i][flurid],$nachweis[$i][rissnummer],$dbname),"</td>
     <td><small>",$nachweis[$i][flurid],"</td>
     <td><small>",$art,"</td>
     <td>",$nachweis[$i][format],"</td>
     <td>",$nachweis[$i][name],"</td>
     <td>",$nachweis[$i][datum],"</td>
    <td><a href=\"nachweise_anzeigen.php?nachweis_id=$nachweis_id&flur_id=$id&wohin=gemarkung&sort=$sortierfeld\"><img src=\"images/buttons/dok.png\" width=20 border=0 alt=\"Nachweis anzeigen\"></a></td>
    <td><a href=\"nachweis_history.php?id=$id&nachweis_id=$nachweis_id\"><img src=\"images/buttons/s_info.png\" width=10 border=0 alt=\"Historie ansehen\"></a></td>
    

    </tr>";
    }
echo "</table><font face=\"arial\">";
echo "<br><br>**) Dokument ist ungültig wegen eines übernommenen Flurneuordnungsverfahrens.<br><br>";


nav_flur("nachweise");
bottom();
?>