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

 xhead_ant();
xmain_nav();
head_flur();
nav_flur("kvwmap");

$id=$_GET["id"];
$sortierfeld=$_GET["sort"];
$highlight=$_GET["highlight"];
$nachfolger=$id+1;
$vorgaenger=$id-1;

$query="SELECT ID,gemkg_id,flur_id FROM flur WHERE ID=$id";
$result=mysqli_query($db_link,$query);
$r=mysqli_fetch_array($result);

flur_kopf($id,$db_link);
navi_flur("nachweise",$id);
abhaken($r["ID"],$db_link,"80",0);

echo"</table>";

$gemarkung=$r["gemkg_id"];
$flur=$r["flur_id"];

while (strlen($flur) < 3)
  {
    $flur='0'.$flur;
  }

$flurid=$gemarkung.$flur;
$query="SELECT n.id as nachweis_id,n.flurid,n.rissnummer,n.blattnummer,nd.art,n.datum,n.vermstelle,n.gueltigkeit,n.link_datei,n.format,v.id,v.name from  nachweisverwaltung.n_vermstelle as v,nachweisverwaltung.n_nachweise as n LEFT JOIN nachweisverwaltung.n_dokumentarten as nd ON (n.art=nd.id) WHERE n.flurid='$flurid' AND CAST(n.vermstelle AS INTEGER)=v.id ORDER BY rissnummer,blattnummer,art";


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

echo "<font face=\"arial\"><a href=\"flur_riss.php?gemark_id=$gemarkung&id=$id\">Rissnummer anfordern</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"nachweise_gem.php?id=$id&sort=rissnummer\">gesamte Gemarkung anzeigen</a><h3>&nbsp;&nbsp;
 $count Nachweise gefunden
</h3></font>";

echo "<table>
      <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
      <td width=\"80\"><a href=\"xnachweise.php?id=$id&sort=rissnummer\">Nummer</a></td>
      <td width=\"50\">Blatt</td>
      <td width=\"80\">Antrag</td>
      <td width=\"50\"><a href=\"xnachweise.php?id=$id&sort=art\">Art</a></td>
      <td width=\"70\"><a href=\"xnachweise.php?id=$id&sort=format\">Format</a></td>
      <td width=\"200\"><a href=\"xnachweise.php?id=$id&sort=name\">Vermessungsstelle</a></td>
      <td><a href=\"xnachweise.php?id=$id&sort=datum\">Datum</a></td></tr>";

$color="#FCFCFC";
for ($i=1;$i<=$count;$i++)
    {
     $art=$nachweis[$i]["art"];

    $nachweis_id=$nachweis[$i]["nachweis_id"];
    $rissnummer=$nachweis[$i]["rissnummer"];
    while (strlen($rissnummer) < 8)
    {
      $rissnummer="0".$rissnummer;
    }
     $dname="/docs/".$nachweis[$i]['flurid']."/".$rissnummer."/".$nachweis[$i]['link_datei']; 
     if($nachweis[$i][$sortierfeld] != $nachweis[$i-1][$sortierfeld]) $color=changecolor($color);
     if ($nachweis_id == $highlight) echo "<tr bgcolor=#E269A9 ";
        else echo "<tr bgcolor=$color ";
		
         echo "style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td><a name=\"$nachweis_id\"><b>",$nachweis[$i]["rissnummer"],"</b></a>";
	 if ($nachweis[$i]["gueltigkeit"] == '0') echo " **";
	 echo "</td>
     <td>",$nachweis[$i]["blattnummer"],"</td>
     <td>",get_antrag($nachweis[$i]["flurid"],$nachweis[$i]["rissnummer"],$db_link),"</td>
     <td>",$art,"</td>
     <td>",$nachweis[$i]["format"],"</td>
     <td>",$nachweis[$i]["name"],"</td>
     <td>",$nachweis[$i]["datum"],"</td>
    <td><a href=\"nachweise_anzeigen.php?nachweis_id=$nachweis_id&flur_id=$id&wohin=flur&sort=$sortierfeld\" width=20 border=0><img src=\"images/buttons/dok.png\" width=20 border=0 alt=\"Nachweis anzeigen\"></a></td>

    </tr>";
    }
echo "</table><font face=\"arial\">";
echo "<br><br>**) Dokument ist ungültig wegen eines übernommenen Flurneuordnungsverfahrens.<br><br>";


nav_flur("nachweise");
bottom();
?>