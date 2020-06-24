<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();
$fehler=$_GET["fehler"];
$status=$_GET["status"];

$page=$_GET["page"];
$highlight=$_GET["highlight"];

if($fehler ==0)
{
 if ($status == '0') $searchquery="SELECT * from ant_search where mitarb_id='$mitarb_id';";
 if ($status != '0') $searchquery="SELECT * from ant_status where status_id='$status';";
$antresult=mysql_query($searchquery,$db_link);
$ant_r=mysql_fetch_array($antresult);
$query=$ant_r[query];
$tabtext=$ant_r[tabtext];
$datart=$ant_r[datart];
$gemark=$ant_r[gemark_id];
$query=$query.";";

$result=mysql_query($query,$db_link);
$treffer=0;
while($r=mysql_fetch_array($result)) $treffer++;
$pagequot=$treffer%10;
$maxpage=$treffer/10;
if ($pagequot==0) $maxpage=$maxpage-1;
if ($pagequot!=0) $maxpage=absolute($maxpage);
$offset=$page*10;
$query=$ant_r[query]." LIMIT $offset,10;";
$result=mysql_query($query,$db_link);
$nextpage=$page+1;
$prevpage=$page-1;
echo "<table><tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\"><td>";
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$treffer;
echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";
if ($page >0) echo "<td><a href=\"ant_searchlist.php?page=0&status=$status\"><img src=\"images/buttons/b_firstpage.png\" alt=\"Zur ersten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"ant_searchlist.php?page=$prevpage&status=$status\"><img src=\"images/buttons/b_prevpage.png\" alt=\"Zur vorherigen Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</td>";
if ($page == 0) echo "<td width=\"30\">&nbsp;";
if ($page < $maxpage) echo "<td><a href=\"ant_searchlist.php?page=$nextpage&status=$status\"><img src=\"images/buttons/b_nextpage.png\" alt=\"Zur n&auml;chsten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"ant_searchlist.php?page=$maxpage&status=$status\"><img src=\"images/buttons/b_lastpage.png\" alt=\"Zur letzten Seite\" border=\"0\" width=\"15\"></a>&nbsp;&nbsp;&nbsp;</td>";
echo "<td>&nbsp;&nbsp;&nbsp;</td><td><a href=\"ant_search_print.php?status=$status\" target=\"about_blank\">Druckansicht</a></td>";

if ($gemark != '0') echo "<td><input type=button value=\"Inhaltsverzeichnis\" onClick='window.open(\"ant_search_inhalt.php\",\"Fenster\",\"\")'></td> ";
echo "</tr></table>";
echo"
<table border=\"0\" >
<tr>
 <td colspan=\"6\" align=\"center\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">";
 if ($status == '0') echo "Suchergebnisse";
 if ($status != '0')
   {
     $query5="SELECT * FROM aktort WHERE aktort_id=$status";
     $result5=mysql_query($query5,$db_link);
     $r5=mysql_fetch_array($result5);
     echo"$r5[aktort]";
   }

  echo "</td>
</tr>
<tr bgcolor=\"#76AAC9\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td rowspan=\"2\" width=\"35\">Antrag</td>
 <td width=\"200\">Vermessungsstelle</td>
 <td width=\"150\">Gemarkung</td>
 <td width=\"60\">Flur</td>
 <td width=\"90\">Flst.(alt)</td>
 <td rowspan=\"2\" width=\"100\">Bearbeiten</td>
 </tr>
 <tr bgcolor=\"#76AAC9\" style=\"font-family:Arial; font-size: 10pt\">
 <td >Vermessungsart </td>
 <td>Sachverhalt </td>
 <td><small>Übernahmedatum</small></td>
 <td>Aktenort</td>
</tr>
<small>";
$i=1;
while($r=mysql_fetch_array($result))
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
    if ($highlight==$r[id]) $Farbe="#FC8FA5";
    $xquery="SELECT * from antrag_extra where id = $r[id]";
    $xresult=mysql_query($xquery,$db_link);
    if ($xr=mysql_fetch_array($xresult))
    {
     $extra = 1;
     $g=0;
     $v=0;
     $m=0;
     $u=0;
     $re=0;
     if (($r[vermst_id]>0) AND ($r[vermart_id] !=0) AND ($r[gemark_id_1] !=0)) $g=1;
    if ($xr[vorb_ja_nein]>0) $v=1;
    if (($xr[me_ja_nein]>0) OR ($xr[vermart_id]=='10')) $m=1;
    if (($xr[alb_ja_nein]>0) AND ($xr[alk_ja_nein]>0) AND ($xr[ueb_ja_nein]>0)OR ($r[vermart_id]=='10')) $u=1;
    if (($xr[re_ja_nein]>0) OR ($xr[vermart_id]=='10')) $re=1;
    $checksum=$g+$v+$m+$u+$re;
   }
    $aktenz=$r[number]."/".substr($r[year],2,2);
  echo"
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td rowspan=\"2\" align=\"center\"><input type=button value=\"$aktenz\" onClick='window.open(\"ant_overview_print.php?id=$r[id]\")'>";
  if ($r[hurry] == "1") echo "&nbsp;<br>(eilig)&nbsp;";
  if ($r[lk] == "Wa") echo "&nbsp;<br>WRN&nbsp;";
  if ($r[lk] == "Ro") echo "&nbsp;<br>RM&nbsp;";
  if ($r[lk] == "Mc") echo "&nbsp;<br>MC&nbsp;";
  if ($r[lk] == "Nz") echo "&nbsp;<br>NZ&nbsp;";
  echo "</td> <td>";
     $query3="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result3=mysql_query($query3,$db_link);
     $r3=mysql_fetch_array($result3);
     echo"$r3[vermst]
  </td>
  <td>";

     echo get_gemark_name($r[gemark_id_1],$dbname),"&nbsp;($r[gemark_id_1])";
     if ($r[gemark_id_2] > 0) echo "<br>", get_gemark_name($r[gemark_id_2],$dbname),"&nbsp;($r[gemark_id_2])";
     if ($r[gemark_id_3] > 0) echo "<br>", get_gemark_name($r[gemark_id_3],$dbname),"&nbsp;($r[gemark_id_3])";

  echo "</td>
  <td>";
  $fquery="SELECT * from flur WHERE gemkg_id='$r[gemark_id_1]' AND flur_id='$r[flur_1]'";
  $fresult=mysql_query($fquery,$db_link);  
  $fr=mysql_fetch_array($fresult);
  echo "<a href=\"flur_edit_alkis.php?id=$fr[ID]\">$r[flur_1]</a>";
  if ($r[flur_2] !="") echo "<br>$r[flur_2]";
  if ($r[flur_3] !="") echo "<br>$r[flur_3]";
  echo "</td>
  <td>";
  echo showarray($r[flst_1alt],0,10);
  if ($r[flur_2] !="") echo "<br>",showarray($r[flst_2alt],0,10);
  if ($r[flur_3] !="") echo "<br>",showarray($r[flst_3alt],0,10);
  echo "</td>
  <td rowspan=\"2\">";
  If ($extra =='1')
  {
  echo "<table border=\"0\"><tr>";
  echo "<td><a href=\"ant_aendern.php?id=$r[id]&page=$page&status=$status\"><small>G</small></a>&nbsp;</td>";
  echo "<td><a href=\"ant_aendern_vorb.php?id=$r[id]&page=$page&status=$status\"><small>V</small></a></td>
  <td><a href=\"ant_aendern_me.php?id=$r[id]&page=$page&status=$status\"><small>M</small></a></td>
  <td><a href=\"ant_aendern_uebernahme.php?id=$r[id]&page=$page&status=$status\"><small>&Uuml;</small></a></td>
  <td><a href=\"ant_aendern_rech.php?id=$r[id]&page=$page&status=$status\"><small>R</small></td>
 <td><a href=\"ant_nachweise.php?id=$r[id]&page=$page&status=$status&alt=no\"><small>N</small></td>
  </tr>";
  if (($r[aktort_id] != '8') AND ($checksum  != '5'))
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
    if ($r[aktort_id] == '8') echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"6\" width=\"95\" align=\"center\" bgcolor=\"#FF0000\">storniert</td></tr>";
    if (($checksum ==5) AND ($r[aktort_id] != '8')) echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"6\" width=\"95\" bgcolor=\"#00FF00\" align=\"center\">erledigt</td></tr>";
  }
  echo "</table>";
  }
  else echo "<a href=\"ant_aendern_alt.php?id=$r[id]&page=$page&status=$status\"><small>G</small></a>
<a href=\"ant_nachweise.php?id=$r[id]&page=$page&status=$status\"><small>N</small></a>";

  echo "</td>

  </tr>\n
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt\">
 <td>";
     $query8="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result8=mysql_query($query8,$db_link);
     $r8=mysql_fetch_array($result8);
     echo"$r8[vermart]
  </td>
 <td>$r[sv] </td>";
 if ($datart == "riss")
  {
   echo "<td>";
   if ($gemark == $r[gemark_id_1] AND $r[gemark_id_1] > '0') echo $r[riss_1];
   if ($gemark == $r[gemark_id_2] AND $r[gemark_id_2] > '0') echo "<br>$r[riss_2]";
   if ($gemark == $r[gemark_id_3] AND $r[gemark_id_3] > '0')echo "<br>$r[riss_3]";

   if ($gemark == '0')
     {
       if ($r[riss_1] > 0) echo $r[riss_1];
       if ($r[riss_2] > 0) echo "<br>$r[riss_2]";
       if ($r[riss_3] > 0) echo "<br>$r[riss_3]";
     }

   echo "</td>";
   }
   else echo" <td>$r[ueb_datum]</td>";

  echo "<td>";
     $query5="SELECT * FROM aktort WHERE aktort_id=$r[aktort_id]";
     $result5=mysql_query($query5,$db_link);
     $r5=mysql_fetch_array($result5);
     echo"$r5[aktort]
 </td>
</tr>";
$i=$i+1;
  }

echo "</small></table>";

if ($i == 1)
  {
  echo "<table>
  <tr>
 <td><h2>Leider nichts gefunden...</h2> </td>
 <td> <img src=\"images/error.jpg\" alt=\"\" border=\"0\" width=\"150\"></td>
</tr>
  </table>";
  }
}
else
{
echo "<h3>Sie haben die Suche nicht azsreichend eingegrenzt !<br>Bitte geben Sie mindestens ein Suchkriterium ein.<br></h3><img src=\"images/error.jpg\" alt=\"\" border=\"0\" width=\"150\">";
}
echo "<br>";


echo "<table><tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\"><td>";
echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$treffer;
echo "</td><td>&nbsp;&nbsp;&nbsp;</td>";
if ($page >0) echo "<td><a href=\"ant_searchlist.php?page=0&status=$status\"><img src=\"images/buttons/b_firstpage.png\" alt=\"Zur ersten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"ant_searchlist.php?page=$prevpage&status=$status\"><img src=\"images/buttons/b_prevpage.png\" alt=\"Zur vorherigen Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</td>";
if ($page == 0) echo "<td width=\"30\">&nbsp;</td>";
if ($page < $maxpage) echo "<td><a href=\"ant_searchlist.php?page=$nextpage&status=$status\"><img src=\"images/buttons/b_nextpage.png\" alt=\"Zur n&auml;chsten Seite\" border=\"0\" width=\"15\"></a></td><td><a href=\"ant_searchlist.php?page=$maxpage&status=$status\"><img src=\"images/buttons/b_lastpage.png\" alt=\"Zur letzten Seite\" border=\"0\" width=\"15\"></a></td>";
echo "</tr></table>";
nav_ant();
bottom();
?>