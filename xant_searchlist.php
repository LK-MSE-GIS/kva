<?php

include("connect.php");
include("function.php");

/*------------Navigation------------*/
xhead_ant();
xmain_nav();
xnav_ant();

/*------------Grundfunktionen------------*/
$fehler=$_GET["fehler"];
$status=$_GET["status"];

$page=$_GET["page"];
$highlight=$_GET["highlight"];

/*------------SELECT-Mitarbeiter-Abfrage------------*/
if($fehler ==0)
{
 if ($status == '0') $searchquery="SELECT * from ant_search where mitarb_id='$mitarb_id';";
 if ($status != '0') $searchquery="SELECT * from ant_status where status_id='$status';";
 
/*------------Grund-Query------------*/
$antresult=mysqli_query($db_link,$searchquery);
$ant_r=mysqli_fetch_array($antresult);
$query=$ant_r["query"];
$tabtext=$ant_r["tabtext"];
$datart=$ant_r["datart"];
$gemark=$ant_r["gemark_id"];
$query=$query.";";

$result=mysqli_query($db_link,$query);

/*-----------------Funktion-Seitenzahl----------------*/
/*------------Funktion-Anzahl-Datenanzeige------------*/
$treffer=0;
while($r=mysqli_fetch_array($result)) $treffer++;
$pagequot=$treffer%10;
$maxpage=$treffer/10;
if ($pagequot==0) $maxpage=$maxpage-1;
if ($pagequot!=0) $maxpage=absolute($maxpage);
$offset=$page*10;
$query=$ant_r["query"]." LIMIT $offset,10;";

/*--------------Funktion-Button-Nächste-Letzte-Seite-------------*/
$result=mysqli_query($db_link,$query);
$nextpage=$page+1;
$prevpage=$page-1;




/*-----------------Struktur-Seitenzahl----------------*/
echo "<div class=\"ausgabe_bereich\"><table><tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\"><td>";

/*-----------------Anzeige-Seitenzahl-Trefferzahl----------------*/
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$treffer;
echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";

/*-----------------Button-Nächste-Letzte-Seite----------------*/
if ($page >0) echo "<td><a href=\"xant_searchlist.php?page=0&status=$status\"><img src=\"images/buttons/b_firstpage.png\" alt=\"Zur ersten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"xant_searchlist.php?page=$prevpage&status=$status\"><img src=\"images/buttons/b_prevpage.png\" alt=\"Zur vorherigen Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</td>";
if ($page == 0) echo "<td width=\"30\">&nbsp;";
if ($page < $maxpage) echo "<td><a href=\"xant_searchlist.php?page=$nextpage&status=$status\"><img src=\"images/buttons/b_nextpage.png\" alt=\"Zur nächsten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"xant_searchlist.php?page=$maxpage&status=$status\"><img src=\"images/buttons/b_lastpage.png\" alt=\"Zur letzten Seite\" border=\"0\" width=\"15\"></a>&nbsp;&nbsp;&nbsp;</td>";

/*-----------------Button-Druckansicht----------------*/
echo "<td>&nbsp;&nbsp;&nbsp;</td><td><a href=\"ant_search_print.php?status=$status\" target=\"about_blank\">Druckansicht</a></td>";

/*-----------------Button-Inhaltsverzeichnis----------------*/
echo "</tr></table></div>";

/*-----------------Struktur-Suchergebnisse----------------*/
echo"
<div class=\"formular_bereich\">
	<table border=\"0\" >
		<tr>
			<td colspan=\"6\" align=\"center\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">";
			if ($status == '0') echo "Suchergebnisse";
			if ($status != '0')
			{
				$query5="SELECT * FROM aktort WHERE aktort_id=$status";
				$result5=mysqli_query($db_link,$query5);
				$r5=mysqli_fetch_array($result5);
				echo"$r5[aktort]";
			}
   
   
/*-----------------Struktur-Suchergebnisse----------------*/
  echo "</td>
</tr>
<tr bgcolor=\"#76AAC9\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td rowspan=\"2\" width=\"35\">Antrag</td>
 <td width=\"200\">Vermessungsstelle</td>
 <td width=\"150\">Gemarkung</td>
 <td width=\"60\">Flur</td>
 <td style='max-width: 20px;'>Flst.(neu)</td>
 <td width=\"90\">Flst.(alt)</td>
 <td rowspan=\"2\" width=\"100\">Bearbeiten</td>
 </tr>
 <tr bgcolor=\"#76AAC9\" style=\"font-family:Arial; font-size: 10pt\">
 <td >Vermessungsart </td>
 <td>Sachverhalt </td>
 <td><small>Übernahmedatum</small></td>
 <td>Aktenort</td>
 <td>Aktenort</td>
</tr>
<small>";

/*-----------------Farbgebung-der-Zeilen----------------*/
$i=1;
while($r=mysqli_fetch_array($result))
  {
    $quot=$i%2;
    $extra=0;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
    if ($highlight==$r["id"]) $Farbe="#FC8FA5";
    $yquery="SELECT * from antrag where id = $r[id]";
    $yresult=mysqli_query($db_link,$yquery);
    $yr=mysqli_fetch_array($yresult);
	
	$xquery="SELECT * from antrag_extra where id = $r[id]";
    $xresult=mysqli_query($db_link,$xquery);
    if ($xr=mysqli_fetch_array($xresult))
    {
     $extra = 1;
     $g=0;
     $v=0;
     $m=0;
     $u=0;
     $re=0;
     if (($yr["vermst_id"]>0) AND ($yr["vermart_id"] !=0) AND ($yr["gemark_id_1"] !=0)) $g=1;
    if ($xr["vorb_ja_nein"]>0) $v=1;
    if (($xr["me_ja_nein"]>0) OR ($xr["vermart_id"]=='10')) $m=1;
    if (($xr["alb_ja_nein"]>0) AND ($xr["alk_ja_nein"]>0) AND ($xr["ueb_ja_nein"]>0)OR ($r["vermart_id"]=='10')) $u=1;
    if (($xr["re_ja_nein"]>0) OR ($xr["vermart_id"]=='10')) $re=1;
    $checksum=$g+$v+$m+$u+$re;
   }
    $aktenz=$yr["number"]."/".substr($yr["year"],2,2);
  echo"
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td rowspan=\"2\" align=\"center\"><input type=button value=\"$aktenz\" onClick='window.open(\"ant_overview_print.php?id=$r[id]\")'>";
  if ($yr["hurry"] == "1") echo "&nbsp;<br>(eilig)&nbsp;";
  if ($yr["lk"] == "Wa") echo "&nbsp;<br>WRN&nbsp;";
  if ($yr["lk"] == "Ro") echo "&nbsp;<br>RM&nbsp;";
  if ($yr["lk"] == "Mc") echo "&nbsp;<br>MC&nbsp;";
  if ($yr["lk"] == "Mc") echo "&nbsp;<br>MC&nbsp;";
  if ($yr["lk"] == "Nz") echo "&nbsp;<br>NZ&nbsp;";
  echo "</td> <td>";
     $query3="SELECT * FROM vermst WHERE vermst_id=$yr[vermst_id]";
     $result3=mysqli_query($db_link,$query3);
     $r3=mysqli_fetch_array($result3);
     echo"$r3[vermst]
  </td>
  <td>";
  
  
/*-----------------SELECT-Gemarkung----------------*/
	$queryz="SELECT gemarkung_id FROM fluren2antrag WHERE antrag=$r[id]";
    $resultz=mysqli_query($db_link,$queryz);

	while($zr=mysqli_fetch_array($resultz))
	{
		echo get_gemark_name($zr["gemarkung_id"],$db_link),"&nbsp;($zr[gemarkung_id])";
		echo "<br>";
	}

  echo "</td>
  <td>";
  
	$queryf="SELECT flur FROM fluren2antrag WHERE antrag=$r[id]";
    $resultf=mysqli_query($db_link,$queryf);

	while($rf=mysqli_fetch_array($resultf))
	{
		echo "$rf[flur]";
		echo "<br>";
	} 
  
  /*--$fquery="SELECT * from flur WHERE gemkg_id='$yr[gemark_id_1]' AND flur_id='$yr[flur_1]'";
  $fresult=mysqli_query($db_link,$fquery);  
  $fr=mysqli_fetch_array($fresult);
  echo "<a href=\"flur_edit_alkis.php?id=$fr[ID]\">$yr[flur_1]</a>";
  if ($yr["flur_2"] !="") echo "<br>$yr[flur_2]";
  if ($yr["flur_3"] !="") echo "<br>$yr[flur_3]";--*/
  
  echo "</td>
  <td>";
	$queryfn="SELECT flst_neu FROM fluren2antrag WHERE antrag=$r[id]";
    $resultfn=mysqli_query($db_link,$queryfn);
  
	while($rfn=mysqli_fetch_array($resultfn))
	{
		echo "$test";
		echo "<br>";
	} 
  
  echo "</td>
  <td>";
	$queryfa="SELECT flst_alt FROM fluren2antrag WHERE antrag=$r[id]";
    $resultfa=mysqli_query($db_link,$queryfa);
  
	while($rfa=mysqli_fetch_array($resultfa))
	{
		echo "$rfa[flst_alt]";
		echo "<br>";
	}  
  
  /*--echo showarray($yr["flst_alt"],0,10);
  if ($yr["flur_2"] !="") echo "<br>",showarray($yr["flst_2alt"],0,10);
  if ($yr["flur_3"] !="") echo "<br>",showarray($yr["flst_3alt"],0,10);--*/
  echo "</td>
  <td rowspan=\"2\">";
  If ($extra =='1')
  {
  echo "<div><table border=\"0\"><tr>";
  echo "<td><a href=\"xant_aendern.php?id=$r[id]&page=$page&status=$status\"><small>G</small></a>&nbsp;</td>";
  echo "<td><a href=\"xant_aendern_vorb.php?id=$r[id]&page=$page&status=$status\"><small>V</small></a></td>
  <td><a href=\"xant_aendern_me.php?id=$r[id]&page=$page&status=$status\"><small>M</small></a></td>
  <td><a href=\"xant_aendern_uebernahme.php?id=$r[id]&page=$page&status=$status\"><small>&Uuml;</small></a></td>
  <td><a href=\"xant_aendern_rech.php?id=$r[id]&page=$page&status=$status\"><small>R</small></td>
 <td><a href=\"xant_nachweise.php?id=$r[id]&page=$page&status=$status&alt=no\"><small>N</small></td>
  </tr>";
  if (($yr["aktort_id"] != '8') AND ($checksum  != '5'))
  {
   echo "<tr>
  <td>";
  if ($g==1) echo "<img src=\"images/buttons/s_okay.png\"  border=\"0\" width=\"15\">";
  else echo "<img src=\"images/buttons/s_error.png\"  border=\"0\" width=\"15\">";
  echo "</td><td>";
  if ($v==1) echo "<img src=\"images/buttons/s_okay.png\"  border=\"0\" width=\"15\">";
  else echo "<img src=\"images/buttons/s_error.png\"  border=\"0\" width=\"15\">";
  echo "</td><td>";
  if ($m==1) echo "<img src=\"images/buttons/s_okay.png\"  border=\"0\" width=\"15\">";
  else echo "<img src=\"images/buttons/s_error.png\"  border=\"0\" width=\"15\">";
  echo "</td><td>";
  if ($u==1) echo "<img src=\"images/buttons/s_okay.png\"  border=\"0\" width=\"15\">";
  else echo "<img src=\"images/buttons/s_error.png\"  border=\"0\" width=\"15\">";
  echo "</td><td>";
  if ($re==1) echo "<img src=\"images/buttons/s_okay.png\"  border=\"0\" width=\"15\">";
  else echo "<img src=\"images/buttons/s_error.png\"  border=\"0\" width=\"15\">";

  echo "</td></tr>";
  }
  else
  {
    if ($yr["aktort_id"] == '8') echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"6\" width=\"95\" align=\"center\" bgcolor=\"#FF0000\">storniert</td></tr>";
    if (($checksum ==5) AND ($yr["aktort_id"] != '8')) echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"6\" width=\"95\" bgcolor=\"#00FF00\" align=\"center\">erledigt</td></tr>";
  }
  echo "</table></div>";
  }
  else echo "<a href=\"xant_aendern_alt.php?id=$r[id]&page=$page&status=$status\"><small>G</small></a>
<a href=\"xant_nachweise.php?id=$r[id]&page=$page&status=$status\"><small>N</small></a>";

  echo "</td>

  </tr>\n
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt\">
 <td>";
     $query8="SELECT * FROM vermart WHERE vermart_id=$yr[vermart_id]";
     $result8=mysqli_query($db_link,$query8);
     $r8=mysqli_fetch_array($result8);
     echo"$r8[vermart]
  </td>
 <td>$yr[sv] </td>";
 if ($datart == "riss")
  {
   echo "<td>";
   if ($gemark == $yr["gemark_id_1"] AND $yr["gemark_id_1"] > '0') echo $yr["riss_1"];
   if ($gemark == $yr["gemark_id_2"] AND $yr["gemark_id_2"] > '0') echo "<br>$yr[riss_2]";
   if ($gemark == $yr["gemark_id_3"] AND $yr["gemark_id_3"] > '0')echo "<br>$yr[riss_3]";

   if ($gemark == '0')
     {
       if ($r["riss_1"] > 0) echo $yr["riss_1"];  
       if ($r["riss_2"] > 0) echo "<br>$yr[riss_2]";
       if ($r["riss_3"] > 0) echo "<br>$yr[riss_3]";
     }

   echo "</td>";
   }
   else echo" <td>$yr[ueb_datum]</td>";

  echo "<td>";
     $query5="SELECT * FROM aktort WHERE aktort_id=$yr[aktort_id]";
     $result5=mysqli_query($db_link,$query5);
     $r5=mysqli_fetch_array($result5);
     echo"$r5[aktort]
 </td>";
 echo "<td>";
     $query5="SELECT * FROM aktort WHERE aktort_id=$yr[aktort_id]";
     $result5=mysqli_query($db_link,$query5);
     $r5=mysqli_fetch_array($result5);
     echo"$r5[aktort]
 </td>
</tr>";
$i=$i+1;
  }

echo "</small></table></div>";

if ($i == 1)
  {
  echo "<div class=\"ausgabe_bereich\"><table>
  <tr  bgcolor=\"white\">
 <td><h2>Leider nichts gefunden...</h2> </td>
 <td> <img src=\"images/lupe_animiert.gif\" alt=\"\" border=\"0\" width=\"200\"></td>
</tr>
  </table></div>";
  }
}
else
{
echo "<div class=\"ausgabe_bereich\"><h3>Sie haben die Suche nicht ausreichend eingegrenzt !<br>Bitte geben Sie mindestens ein Suchkriterium ein.<br></h3><img src=\"images/error.jpg\" alt=\"\" border=\"0\" width=\"150\"></div>";
}
echo "<br>";


echo "<div class=\"ausgabe_bereich\"><table><tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\"><td>";
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$treffer;
echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";
if ($page >0) echo "<td><a href=\"xant_searchlist.php?page=0&status=$status\"><img src=\"images/buttons/b_firstpage.png\" alt=\"Zur ersten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"xant_searchlist.php?page=$prevpage&status=$status\"><img src=\"images/buttons/b_prevpage.png\" alt=\"Zur vorherigen Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</td>";
if ($page == 0) echo "<td width=\"30\">&nbsp;</td>";
if ($page < $maxpage) echo "<td><a href=\"xant_searchlist.php?page=$nextpage&status=$status\"><img src=\"images/buttons/b_nextpage.png\" alt=\"Zur n&auml;chsten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"xant_searchlist.php?page=$maxpage&status=$status\"><img src=\"images/buttons/b_lastpage.png\" alt=\"Zur letzten Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</tr></table></div>";

/*------------Navigation------------*/
xnav_ant();
bottom();
?>