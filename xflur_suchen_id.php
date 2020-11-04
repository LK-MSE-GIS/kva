<?php

include("connect.php");
include("function.php");




xhead_ant();
xmain_nav();
head_flur();
nav_flur("alkgrund");
echo "<div class=\"ausgabe_bereich\">";

$gemkg_id1=$_POST["gemkg_id1"];
$gemkg_id2=$_POST["gemkg_id2"];

if (strlen($gemkg_id1) < '4') $gemkg_id=$gemkg_id2;
if (strlen($gemkg_id2) == '0') $gemkg_id=$gemkg_id1;


$query="SELECT * FROM flur WHERE gemkg_id= '$gemkg_id'";


$result=mysqli_query($db_link,$query);
$treffer=0;
echo"<table border=\"0\" >
<tr bgcolor=\"#D8DCDE\">
 <td colspan=\"11\" align=\"center\" style=\"font-family:Arial; font-size: 14pt; font-weight: bold\">Suchergebnisse</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" bgcolor=\"#76AAC9\">
 <td width=\"150\">Gemarkung</td>
 <td width=\"80\">ID</td>
 <td width=\"60\">Flur</td>";

 echo "
  <td><img src=\"images/buttons/nachweise_gray.gif\"  border=\"0\" width=\"60\"></td>

  <td><img src=\"images/buttons/alk_grund_gray.gif\"  border=\"0\" width=\"60\"></td>
 <td><img src=\"images/buttons/alk_strha_gray.gif\"  border=\"0\" width=\"60\"></td>
  <td><img src=\"images/buttons/alk_geb_gray.gif\"  border=\"0\" width=\"60\"></td>
  <td><img src=\"images/buttons/alkis_gray.gif\"  border=\"0\" width=\"60\"></td>
  <td><img src=\"images/buttons/bos_gray.gif\"  border=\"0\" width=\"60\"></td>
  <td><img src=\"images/buttons/kvwmap_gray.gif\"  border=\"0\" width=\"60\"></td>

  </tr>";
$i=1;
while($r=mysqli_fetch_array($result))
  {

  $treffer=$treffer+1;
    $quot=$treffer%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
  if ($r["hist"] == 1) $Farbe="#FF0000";	
  echo"
  <tr bgcolor=$Farbe style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td >";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
     $result4=mysqli_query($db_link,$query4);
     $r4=mysqli_fetch_array($result4);
     echo"&nbsp;$r4[gemarkung]";
     $vcount=0;
     $vquery="SELECT * FROM antrag WHERE ((gemark_id_1 ='$r[gemkg_id]' AND flur_1 = '$r[flur_id]') OR (gemark_id_2 ='$r[gemkg_id]' AND flur_2 = '$r[flur_id]') OR (gemark_id_3 ='$r[gemkg_id]' AND flur_3 = '$r[flur_id]')) AND ((aktort_id ='1' OR aktort_id = '2' OR aktort_id = '3'))";
     $vresult=mysqli_query($db_link,$vquery);
     while($vr=mysqli_fetch_array($vresult))
     {
     $vcount++;
      }
     if ($vcount > 0) echo "&nbsp;<a href=\"xant_vorb_list.php?gemark_id=$r[gemkg_id]&flur_id=$r[flur_id]\" target =\"about_blank\"><img src=\"images/buttons/s_info.png\"  border=\"0\" width=\"15\" alt=\"liste der in Arbeit befindlichen Antr&auml;ge\"></a>&nbsp;($vcount)";
  echo "</td>
  <td>&nbsp;$r[gemkg_id]&nbsp;</td>
  <td>&nbsp;$r[flur_id]&nbsp;";
  if ($r['hist'] == 1) echo "(hist.)";
  echo "</td>";

  echo "
  <td align=\"center\"><a href=\"xnachweise.php?id=$r[ID]&sort=rissnummer\"><img src=\"images/buttons/s_info.png\"  border=\"0\" width=\"20\" alt=\"Zu den Nachweisen\"></a></td>";

  echo "<td align=center>";
  if ($r['db_datum']>'0000-00-00') 
    {
     echo "<a href=\"xflur_edit_alkgrund.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }
  else 
     {
      echo "<a href=\"xflur_edit_alkgrund.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }

  echo "</td><td align=center>";
  if (($r['strha_alk']=='1') AND ($r['strha_alb']=='1')OR ($r["geb"]=='0')) 
    {
     echo "<a href=\"xflur_edit_strha.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }

   else 
     {
      echo "<a href=\"xflur_edit_strha.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }

  echo "</td><td align=center>";
   if (($r['altgeb_db_dat']>'0000-00-00') AND ($r['geb_abschl_dat']>'0000-00-00') OR ($r['geb']=='0'))
    {
     echo "<a href=\"xflur_edit_geb.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }

   else 
     {
      echo "<a href=\"xflur_edit_geb.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }

  echo "</td><td align=center>";
   if ((($r['alkis_feld_stat']=='1') OR ($r['geb']=='0')) AND ($r['alkis_albalk_stat']=='1'))
    {
     echo "<a href=\"xflur_edit_alkis.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }

   else 
     {
      echo "<a href=\"xflur_edit_alkis.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }

  echo "</td><td align=center>";
  if ((($r['bos_exists']=='1') AND ($r['bos_nach_alk'] !='0000-00-00')) OR  $r['bos_exists']=='0') 
    {
     echo "<a href=\"xflur_edit_bos.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }

   else 
     {
      echo "<a href=\"xflur_edit_bos.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }

  echo "</td><td align=center>";
   if (($r['all_riss_dat']>'0000-00-00') AND ($r['gesc_riss_dat']>'0000-00-00') AND ($r['gesc_riss_kvz']=='1') AND ($r['all_riss_kvz']=='1') AND ($r['anlagen_dat'] > '0000-00-00'))
    {
     echo "<a href=\"xflur_edit_kvwmap.php?id=$r[ID]\">";
     plus();
     echo "</a>";
     }

   else 
     {
      echo "<a href=\"xflur_edit_kvwmap.php?id=$r[ID]\">";
      minus();
      echo " </a>";
     }
  echo "</td></tr>";
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
echo "<br>Anzahl der Treffer: ",$treffer,"<br>";

?>