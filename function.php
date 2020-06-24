<?php

    $datum = getdate(time());
    $year=$datum["year"];
    $month=$datum["mon"];
    $day=$datum["mday"];
    $hour=$datum["hours"];
    $min=$datum["minutes"];
    $sec=$datum["seconds"];

    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($hour) == 1) $hour='0'.$hour;
    if (strlen($min) == 1) $min='0'.$min;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$year."-".$month."-".$day;
    $german_date=$day.".".$month.".".$year;

function plus()
{
  echo "<img src=\"images/buttons/plus3.png\" border=\"0\" width=\"25\">";
}

function minus()
{
  echo "<img src=\"images/buttons/minus3.png\" border=\"0\" width=\"25\">";
}



function head_vermst()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Vermessungsstellen
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\">
<h3 align=\"center\">Vermessungsstellen</h3>";
}

function head_order()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Auftragsdatenbank
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\"><font face=\"Arial\">
<h3 align=\"center\">Auftr&auml;ge</h3></font>";
}

function nav_vermst()
  {
 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
 <td> [ <a href=\"vermst_auflistung.php\">Auflistung</a>]
      [ <a href=\"vermst_eintrag.php\">Neuer Eintrag</a>]
      [ <a href=\"ant_suchen.php\">Antragsverwaltung</a>]

</tr>
</table>
<hr>";
}

function nav_orders()
  {
 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
 <td> [ <a href=\"order_new.php\">Neuer Auftrag</a>]
      [ <a href=\"order_search.php\">Auftrag suchen</a>]
      [ <a href=\"ant_suchen.php\">Antragsverwaltung</a>]
</tr>
</table>
<hr>";
}

function head_ant()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Antragsdatenbank Katasteramt
  </title>
  </head>

  <body bgcolor=\"#FCFCFC\">";
}

function nav_ant()
  {
 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
 <td> [ <a href=\"ant_suchen.php\">Suche</a>]
      [ <a href=\"ant_eintrag.php\">Neuer Eintrag</a>]
      [ <a href=\"ant_eintrag_hist.php\">Alter Eintrag</a>]
      [ <a href=\"ant_status.php\">&Uuml;bersicht</a>]
      [ <a href=\"vermst_auflistung.php\">Verm.-st.</a>]
      [ <a href=\"ant_statistik_quest.php\">Statistik</a>]


</tr>
</table>
<hr>";
}

function nav_aendern($id,$dbname,$page,$status)
 {

  $query="SELECT o.*, x.* FROM antrag as o, antrag_extra as x WHERE o.id=$id AND o.id=x.id";
  $result=mysql_query($query);
  $r=mysql_fetch_array($result);

  echo" <table border=\"0\" >
  <tr style=\"font-family:MS Sans Serif; font-size: 10pt; font-weight: normal\">

  <td><a href=\"ant_searchlist.php?page=$page&highlight=$id&status=$status\">Zurück</a>&nbsp;&nbsp;</td>";

  if (($r[vermst_id]>0) AND ($r[vermart_id] !=0) AND ($r[gemark_id_1] > 0)) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern.php?id=$id&page=$page&status=$status\">Grunddaten</a>&nbsp;&nbsp;</td>";

  
  if ($r[vorb_ja_nein]>0) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern_vorb.php?id=$id&page=$page&status=$status\">Vorbereitung</a>&nbsp;&nbsp;</td>";


  if (($r[me_ja_nein]>0) OR ($r[vermart_id]=='10')) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern_me.php?id=$id&page=$page&status=$status\">Messeingang</a>&nbsp;&nbsp;</td>";
  
  if (($r[alb_ja_nein]>0) AND ($r[alk_ja_nein]>0) AND ($r[ueb_ja_nein]>0)OR ($r[vermart_id]=='10')) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern_uebernahme.php?id=$id&page=$page&status=$status\">Übernahme</a>&nbsp;&nbsp;</td>";

  if (($r[re_ja_nein]>0) OR ($r[vermart_id]=='10')) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern_rech.php?id=$id&page=$page&status=$status\">Rechnungen</a>&nbsp;&nbsp;</td>";
  

  echo "<td><a href=\"ant_nachweise.php?id=$id&page=$page&status=$status&alt=no\">Nachweise</a>&nbsp;&nbsp;</td>";

  if ($r[rechts] != '0' AND $r[hoch] != '0')
    {

     echo " <td><a href=\"ant_map.php?rechts=$r[rechts]&hoch=$r[hoch]&range=200&id=$id&page=$page&status=$status\" >Karte</a></td>";
     }

  echo "  </tr></table><br>";
}


function nav_aendern_alt($id,$dbname,$page,$status)
 {

  $query="SELECT * FROM antrag  WHERE id=$id ";
  $result=mysql_query($query);
  $r=mysql_fetch_array($result);

  echo" <table border=\"0\" >
  <tr style=\"font-family:MS Sans Serif; font-size: 10pt; font-weight: normal\">

  <td><a href=\"ant_searchlist.php?page=$page&highlight=$id&status=$status\">Zurück</a>&nbsp;&nbsp;</td>";

  if (($r[vermst_id]>0) AND ($r[gemark_id_1] > 0)) echo "<td>";
  else echo "<td bgcolor=#EEACC4>";
  echo "<a href=\"ant_aendern_alt.php?id=$id&page=$page&status=$status\">Grunddaten</a>&nbsp;&nbsp;</td>";

  echo "<td><a href=\"ant_nachweise.php?id=$id&page=$page&status=$status\">Nachweise</a>&nbsp;&nbsp;</td>";


  
  
  echo "  </tr></table><br>";
}



function head_flur()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Flurdatenbank Katasteramt
  </title>
  </head>

  <body bgcolor=\"#FFFEF4\">";
}

function nav_flur($direction)
  {
  if ($direction == "kvwmap") $dirlink="flur_search_kvwmap.php";
  if ($direction == "alkgrund") $dirlink="flur_search_alkgrund.php";
  if ($direction == "geb") $dirlink="flur_search_geb.php";
  if ($direction == "strha") $dirlink="flur_search_strha.php";
  if ($direction == "alkis") $dirlink="flur_search_alkis.php";
  if ($direction == "bos") $dirlink="flur_search_bos.php";

 echo "<table width=\"100%\" border=\"0\">
<tr>
 <td style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"> [ <a href=\"flur_suchen.php\">Flur suchen</a>]&nbsp;[ <a href=$dirlink>Flur suchen nach Themen </a>]&nbsp;[ <a href=\"flur_statistik.php?new=nein\">Statistik</a>]&nbsp;
[ <a href=\"ant_suchen.php\">Antragsdatenbank</a>]

</tr>
</table>
<hr>";
}


function ok()
  {
  echo "<img src=\"images/ok.jpg\" alt=\"\" border=\"0\"><br><br>";
  }
function error()
  {
  echo "<img src=\"images/error.jpg\" alt=\"\" width=\"150\" border=\"0\"><br><br>";
  }

function bottom()
  {
  echo "</body> </html>";
  }

function abhaken($flurid,$dbn,$width,$nbrkspc)
{

$query4="SELECT * FROM flur WHERE ID=$flurid";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);

 echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td align=center>";
 if ($r4[db_datum]>'0000-00-00') plus();
  else minus();
  echo "<td align=center>";
if (($r4[strha_alk]=='1') AND ($r4[strha_alb]=='1') OR ($r4[geb]=='0')) plus();
  else minus();
  if ($nbrkspc=='1') echo "<td>&nbsp;</td>";
  echo "<td align=center>";
   if (($r4[altgeb_db_dat]>'0000-00-00') AND ($r4[geb_abschl_dat]>'0000-00-00') OR ($r4[geb]=='0'))echo plus();
  else minus();
  if ($nbrkspc=='1') echo "<td>&nbsp;</td>";
  echo "<td align=center>";
   if ((($r4[alkis_feld_stat]=='1') AND ($r4[alkis_felddb_dat]!='0000-00-00')) AND ($r4[alkis_albalk_stat]=='1'))echo plus();
  else minus();
  if ($nbrkspc=='1') echo "<td>&nbsp;</td>";
  echo "<td align=center>";
   if ((($r4[bos_exists]=='1') AND ($r4[bos_nach_alk] !='0000-00-00')) OR  $r4[bos_exists]=='0') plus();
  else minus();
  if ($nbrkspc=='1') echo "<td>&nbsp;</td>";
  echo "<td align=center>";
 if (($r4[all_riss_dat]>'0000-00-00') AND ($r4[gesc_riss_dat]>'0000-00-00') AND ($r4[gesc_riss_kvz]=='1') AND ($r4[all_riss_kvz]=='1') AND ($r4[anlagen_dat]>'0000-00-00') AND ($r4[georef_dat]>'0000-00-00') ) plus();
  else minus();
  if ($nbrkspc=='1') echo "<td>&nbsp;</td>";
  echo "</td></tr></table>";
 }



 function flur_kopf($flurid,$dbname)
 {
 $query="SELECT * FROM flur WHERE ID=$flurid";
 $result=mysql_query($query);
 $r=mysql_fetch_array($result);
 $farbe="#76AAC9";
 if ($r[hist] == 1) $farbe="#FF0000";
 echo "<div align=\"center\"><table border=\"0\">
<tr  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=$farbe>
 <td width=\"120\"> </td>
 <td width=\"300\">Gemarkung </td>
 <td> Gemarkungsnummer</td>
 <td > Flur</td>
 <td> Entstehung der ALK</td>
 </tr>";
 if ($r[hist] == 1)    
    echo "<tr><td colspan=5><marquee>Flur ist historisch !!</td></tr>";
echo "<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td valign=center><form action=\"flur_suchen_id.php\" method=POST>
    <input type=\"hidden\" name=\"gemkg_id2\" value=\"$r[gemkg_id]\">
    <input type=\"submit\" value=\"Zurück\">
    </form></td>
<td>";
$query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
</td>
<td>$r[gemkg_id]</td>
<td style=\"font-family:Arial; font-size: 24pt; font-weight: bold\">$r[flur_id]</td>";
if ($r[vertrag_id]=='0')
  {
   echo "<td>$r[vertrag]</td></tr>";
  }
  else
  {
   $vquery="SELECT * FROM vertrag WHERE vertrag_id=$r[vertrag_id]";
   $vresult=mysql_query($vquery);
   $rv=mysql_fetch_array($vresult);
   echo "<td>$rv[name]<br>";
   $v2query="SELECT * FROM vermst WHERE vermst_id=$rv[vermst_id]";
   $v2result=mysql_query($v2query);
   $rv2=mysql_fetch_array($v2result);
   echo"$rv2[vermst]</td></tr>";
  }
if ($r[bov]>='1')
  {
  $bovquery="SELECT * FROM bov WHERE bov_id=$r[bov]";
  $bovresult=mysql_query($bovquery);
  $bovr=mysql_fetch_array($bovresult);
  echo "<tr><td style=\"font-family:Arial; font-size: 8pt; font-weight: bold\" colspan=\"4\">BOV: $bovr[Name]&nbsp;";
  if ($r[bov_teilw]=='1') echo "(teilweise)";
  echo ",&nbsp;Ausf&uuml;hrende Stelle: $bovr[ausf_vermst]";
  if ($bovr[busy]=='0') echo ", Verfahren ist abgeschlossen";
  if ($bovr[busy]=='1') echo ", Verfahren l&auml;uft noch";
  echo "</td></tr>";
  }
if ($r[geb]=='0') echo "<tr><td style=\"font-family:Arial; font-size: 8pt; font-weight: bold\">kein Geb&auml;udebestand</td></tr>";

echo "</table><br>";
}

function nachweis_kopf($flurid,$dbname)
 {
 $query="SELECT * FROM flur WHERE ID=$flurid";
 $result=mysql_query($query);
 $r=mysql_fetch_array($result);
 echo "<div align=\"center\"><table border=\"0\">
<tr  style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">
 <td colspan=2>Nachweise in der Gemarkung: ";
 
$query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
</td></tr><tr><td width=200 style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"><a href=\"nachweise.php?id=$flurid&sort=rissnummer\">zurück zur Flur ",$r[flur_id],"</td><td width=200 style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"><a href=\"document_check.php?gemkg=$r[gemkg_id]\" target=\"_blank\">Gemarkung prüfen</a></td></tr></table><br>";
}




function head_baustellen()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Baustellen
  </title>
  </head>

  <body bgcolor=\"#000000\" text=\"#FCFDBF\">
<h3 align=\"center\" style=\"font-family:Arial; font-size: 24pt; font-weight: bold\">Baustellen</h3>";
}


function write_log($fn,$logcontent)
{
  $filename="log/".$fn;
  $logcontent=$logcontent."\n";
  if (file_exists($filename))
   {
     $logfile=fopen($filename,"a");
   }
   else
   {
     $logfile=fopen($filename,"w");
   }
   fputs($logfile,$logcontent);
   fclose($logfile);
}

function navi_flur($what,$id)
{
   echo" <font face=\"Arial\" size=\"-1\"><table border=\"0\">
   <tr>
   <td>";
   if ($what == 'nachweise')
   { echo "<img src=\"images/buttons/nachweise_red.gif\"  border=\"0\" width=\"100\">";}
   else
   { echo "<a href=\"nachweise.php?id=$id&sort=rissnummer\"><img src=\"images/buttons/nachweise_gray.gif\"  border=\"0\" width=\"100\"></a></td>";}
   if ($what == 'fstn')
   { echo "<td><img src=\"images/buttons/flst_red.gif\"  border=\"0\" width=\"100\">";}
   else
   { echo "<td><a href=\"flur_show_fstn.php?id=$id\"><img src=\"images/buttons/flst_gray.gif\"  border=\"0\" width=\"100\"></a></td>";}
   if ($what == 'alk_grund')
   {
     echo "<td><img src=\"images/buttons/alk_grund_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_alkgrund.php?id=$id\"><img src=\"images/buttons/alk_grund_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }
   if ($what == 'alk_strha')
   {
     echo "<td><img src=\"images/buttons/alk_strha_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_strha.php?id=$id\"><img src=\"images/buttons/alk_strha_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }
   if ($what == 'alk_geb')
   {
     echo "<td><img src=\"images/buttons/alk_geb_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_geb.php?id=$id\"><img src=\"images/buttons/alk_geb_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }
   if ($what == 'alkis')
   {
     echo "<td><img src=\"images/buttons/alkis_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_alkis.php?id=$id\"><img src=\"images/buttons/alkis_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }
   if ($what == 'bos')
   {
     echo "<td><img src=\"images/buttons/bos_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_bos.php?id=$id\"><img src=\"images/buttons/bos_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }
   if ($what == 'kvwmap')
   {
     echo "<td><img src=\"images/buttons/kvwmap_red.gif\"  border=\"0\" width=\"100\"></td>";
   }
   else
   {
     echo "<td><a href=\"flur_edit_kvwmap.php?id=$id\"><img src=\"images/buttons/kvwmap_gray.gif\"  border=\"0\" width=\"100\"></a></td>";
   }

echo "</tr></font>";
}

function navi_flur_search($what)
{
echo" <table border=\"0\"><tr>";
if ($what == 'alkgrund') echo "<td><img src=\"images/buttons/alk_grund_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_alkgrund.php\"><img src=\"images/buttons/alk_grund_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

if ($what == 'strha') echo "<td><img src=\"images/buttons/alk_strha_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_strha.php\"><img src=\"images/buttons/alk_strha_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

if ($what == 'geb') echo "<td><img src=\"images/buttons/alk_geb_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_geb.php\"><img src=\"images/buttons/alk_geb_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

if ($what == 'alkis') echo "<td><img src=\"images/buttons/alkis_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_alkis.php\"><img src=\"images/buttons/alkis_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

if ($what == 'bos') echo "<td><img src=\"images/buttons/bos_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_bos.php\"><img src=\"images/buttons/bos_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

if ($what == 'kvwmap') echo "<td><img src=\"images/buttons/kvwmap_red.gif\"  border=\"0\" width=\"100\"></td>";
 else echo "<td><a href=\"flur_search_kvwmap.php\"><img src=\"images/buttons/kvwmap_gray.gif\"  border=\"0\" width=\"100\"></a></td>";

echo "</tr></table>";

}

function absolute($wert)
 {
  $pos1=strpos($wert,".");
  if ($pos1 == false)
   {
    $abswert=$wert;
   }
   else
   {
    $wertarry=explode(".",$wert);
    $abswert=$wertarry[0];
   }

   return $abswert;
  }

function showarray($zk,$start,$laenge)
  {
   $anzeige=substr($zk,$start,$laenge);
   if (strlen($zk) > $laenge) $anzeige=$anzeige."...";
   return $anzeige;
  }

function landkreis($lk)
   {
   if ($lk == 'Mu') $rueckgabe="M&uuml;ritz";
   if ($lk == 'Ro') $rueckgabe="R&ouml;bel";
   if ($lk == 'Mc') $rueckgabe="Malchin";
   if ($lk == 'Nz') $rueckgabe="Neustrelitz";
   return $rueckgabe;
   }


 function get_gemark_name($gemark_id,$dbname)
 {
 $query="SELECT * FROM gemarkung WHERE gemark_id='$gemark_id'";
 $result=mysql_query($query);
 $r=mysql_fetch_array($result);
 return $r[gemarkung];
 }


function get_antrag($flur_id,$rissnummer,$dbname)
 {
  $gemark_id=substr($flur_id,0,6);
   
 $query="SELECT a.number,a.year FROM risse2antrag as r, antrag as a WHERE r.gemark_id='$gemark_id' AND r.riss_id='$rissnummer' AND a.id = r.antrag_id";
 $result=mysql_query($query);
 $r=mysql_fetch_array($result);
 $az=$r[number]."/".substr($r[year],2,2);
 if (strlen($az) > 2) return $az;
   else return " ";
 }


 function get_last_riss($gemark_id,$dbname)
 {
 $query="SELECT last_riss FROM riss_nummer WHERE gemark_id='$gemark_id'";
 $result=mysql_query($query);
 $r=mysql_fetch_array($result);
 return $r[0];
 }



 function get_flst($zk)
  {
  $laenge=strlen($zk);
  for ($i=0; $i<=$laenge;$i++)
    {
     echo $zk[$i];
     $quot=$i%20;
     if($quot ==0 AND $i > 0) echo "<br>";
     }
   }

 function vor_null($zk,$stellen)
  {
   while (strlen($zk) < $stellen)
     {
       $zk="0".$zk;
     }
   return $zk;
  }



?>