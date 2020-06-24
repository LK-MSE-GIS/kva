<?php

include("connect.php");
include("function.php");

head_flur();
nav_flur("alkgrund");

$fselekt=$_GET["fselekt"];
$bov_id="";
$gemark_id="";
$mitarb_id="";
$orderfield=$_GET["orderfield"];
$dir=$_GET["dir"];

 if($dir=="")
  {
  $dir="DESC";
  }
  else
  {
  $dir="";
  }
  

$sel_query="SELECT * from selekt WHERE sel_id=$fselekt";
 $sel_result=mysql_query($sel_query);
 $sel_r=mysql_fetch_array($sel_result);
if (($gemark_id =='0') OR ($gemark_id ==''))
  {
   $query=$sel_r[query];
  }
  else
  {
   $query=$sel_r[query]." AND gemkg_id='$gemark_id'";
  }

if (($mitarb_id =='0') OR ($mitarb_id ==''))
  {
   $query=$sel_r[query];
  }
  else
  {
  if ($fselekt == '501')$query=$sel_r[query]." AND gesc_riss_mitid='$mitarb_id'";
  if ($fselekt == '503')$query=$sel_r[query]." AND gesc_riss_mitid='$mitarb_id'";
  if ($fselekt == '502')$query=$sel_r[query]." AND all_riss_mitid='$mitarb_id'";
  if ($fselekt == '504')$query=$sel_r[query]." AND all_riss_mitid='$mitarb_id'";
  if ($fselekt == '505')$query=$sel_r[query]." AND anlagen_mitid='$mitarb_id'";
  if ($fselekt == '506')$query=$sel_r[query]." AND georef_mitid='$mitarb_id'";
  }



 if ($bov_id >'0') $query=$sel_r[query]." AND bov='$bov_id'";

if ($orderfield != "") $query=$query." ORDER BY $orderfield $dir";

$result=mysql_query($query);
$treffer=0;
echo"
<table border=\"0\" >
<tr>
 <td colspan=\"6\" align=\"center\" style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">$sel_r[tabtext]</td>
</tr>
<tr bgcolor=\"#80FF00\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td width=\"150\">Gemarkung</td>
 <td width=\"80\"><a href=\"flur_selekt2.php?fselekt=$fselekt&orderfield=gemkg_id&dir=$dir\">ID</a></td>
 <td width=\"60\">Flur</td>";
 if ($sel_r[feld3_tabtext] != "") echo "<td><a href=\"flur_selekt2.php?fselekt=$fselekt&orderfield=$sel_r[feld3_item]&dir=$dir\">$sel_r[feld3_tabtext]</a></td>";
    else echo "<td width=\"90\">Vertrag</td>";
 if ($sel_r[feld4_tabtext] != "") echo "<td><a href=\"flur_selekt2.php?fselekt=$fselekt&orderfield=$sel_r[feld4_item]&dir=$dir\">$sel_r[feld4_tabtext]</a></td>";
    else echo "<td width=\"90\">Status</td>";
 echo "<td  width=\"100\">Bearbeiten</td>
 </tr>";
$i=1;
while($r=mysql_fetch_array($result))
  {
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }

    if (($fselekt > 19) AND ($fselekt < 30))
      {
        $bovquery="SELECT * FROM bov WHERE bov_id=$r[bov]";
        $bovresult=mysql_query($bovquery);
        $bovr=mysql_fetch_array($bovresult);
          if ($fselekt == 20)
           {
            $treffer=$treffer+1;
            echo"
            <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
            <td >";
            $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
            $result4=mysql_query($query4);
            $r4=mysql_fetch_array($result4);
            echo"&nbsp;$r4[gemarkung]&nbsp;
            </td>
            <td>&nbsp;$r[gemkg_id]&nbsp;</td>
            <td>&nbsp;$r[flur_id]&nbsp;</td>
            <td>&nbsp;$r[vertrag]&nbsp;</td>
            <td>&nbsp;";
            if ($bovr[busy]=='0') echo "abgeschlossen";
            if ($bovr[busy]=='1') echo "in Arbeit";
            echo "&nbsp;</td>
            <td align=center><a href=\"flur_edit_alkgrund.php?id=$r[ID]\"><img src=\"images/buttons/b_edit.png\" alt=\"Bearbeiten\" border=\"0\"></a></td>
            </tr>\n";
            $i=$i+1;
           }

           if (($fselekt == 21) AND ($bovr[busy]=='1'))
            {
            $treffer=$treffer+1;
            echo"
            <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
            <td >";
            $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
            $result4=mysql_query($query4);
            $r4=mysql_fetch_array($result4);
            echo"&nbsp;$r4[gemarkung]&nbsp;
            </td>
            <td>&nbsp;$r[gemkg_id]&nbsp;</td>
            <td>&nbsp;$r[flur_id]&nbsp;</td>
            <td>&nbsp;$r[vertrag]&nbsp;</td>
            <td>&nbsp;";
            if ($bovr[busy]=='0') echo "abgeschlossen";
            if ($bovr[busy]=='1') echo "in Arbeit";
            echo "&nbsp;</td>
            <td align=center><a href=\"flur_edit_alkgrund.php?id=$r[ID]\"><img src=\"images/buttons/b_edit.png\" alt=\"Bearbeiten\" border=\"0\"></a></td>
            </tr>\n";
            $i=$i+1;
            }
           if (($fselekt == 22) AND ($bovr[busy]=='0'))
            {
             $treffer=$treffer+1;
             echo"
             <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
             <td >";
             $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
             $result4=mysql_query($query4);
             $r4=mysql_fetch_array($result4);
             echo"&nbsp;$r4[gemarkung]&nbsp;
             </td>
             <td>&nbsp;$r[gemkg_id]&nbsp;</td>
             <td>&nbsp;$r[flur_id]&nbsp;</td>
             <td>&nbsp;$r[vertrag]&nbsp;</td>
             <td>&nbsp;";
             if ($bovr[busy]=='0') echo "abgeschlossen";
             if ($bovr[busy]=='1') echo "in Arbeit";
             echo "&nbsp;</td>
             <td align=center><a href=\"flur_edit_alkgrund.php?id=$r[ID]\"><img src=\"images/buttons/b_edit.png\" alt=\"Bearbeiten\" border=\"0\"></a></td>
             </tr>\n";
             $i=$i+1;
             }
            }
            else
            {
             $treffer=$treffer+1;
             echo"
             <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight:       bold\">
             <td >";
             $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemkg_id]";
             $result4=mysql_query($query4);
             $r4=mysql_fetch_array($result4);
             echo"&nbsp;$r4[gemarkung]&nbsp;
             </td>
             <td>&nbsp;$r[gemkg_id]&nbsp;</td>
             <td>&nbsp;$r[flur_id]&nbsp;</td>";
             echo "<td>&nbsp;";
             if ($sel_r[feld3_item] != "")
             {
              $feld3=$sel_r[feld3_item];
              if ($sel_r[feld3_db] > '0')
               {
                if ($sel_r[feld3_db] =='1')
                 {
                  $mquery="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[$feld3]";
                  $mresult=mysql_query($mquery);
                  $rm=mysql_fetch_array($mresult);
                  echo "$rm[name]";
                 }
                }
               else echo "$r[$feld3]";
              }
              else echo "$r[vertrag]";
             echo "<td>&nbsp;";
             if ($sel_r[feld4_item] != "")
             {
              $feld4=$sel_r[feld4_item];
              if ($sel_r[feld4_db] > '0')
               {
                if ($sel_r[feld4_db] =='1')
                 {
                  $m2query="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[$feld4]";
                  $m2result=mysql_query($m2query);
                  $rm2=mysql_fetch_array($m2result);
                  echo "$rm2[name]";
                 }
                }
               else
                {
                 echo "$r[$feld4]";
                }
             }
             else
             {
              if ($fselekt < 10)
              {
               if ($r[strha_amt]==1) echo"kein Bestand";
               if ($r[strha_amt]==0) echo"keine Aktion";
               if ($r[strha_amt]==2) echo"zum Amt";
               if ($r[strha_amt]==3) echo"vom Amt zurück";
               if ($r[strha_amt]==4) echo"BOV";
              }
              if (($fselekt > 499) AND ($fselekt < 600))
              {
               if ($fselekt==500) echo "nichts erfasst";
               if (($fselekt==501) OR ($fselekt==13))
                 {
                   if ($r[gesc_riss_kvz] =='1') echo "mit KVZ";
                   if ($r[gesc_riss_kvz] =='0') echo "ohne KVZ";
                 }
               if (($fselekt==502) OR ($fselekt==504))
                 {
                   if ($r[all_riss_kvz] =='1') echo "mit KVZ";
                   if ($r[all_riss_kvz] =='0') echo "ohne KVZ";
                 }
              }
              if (($fselekt > 19) AND ($fselekt < 30))
              {
               $bovquery="SELECT * FROM bov WHERE bov_id=$r[bov]";
               $bovresult=mysql_query($bovquery);
               $bovr=mysql_fetch_array($bovresult);
               if ($bovr[busy]=='0') echo "abgeschlossen";
               if ($bovr[busy]=='1') echo "in Arbeit";
              }
             }
             echo "&nbsp;</td>
             <td align=center><a href=\"$sel_r[link]?id=$r[ID]\"><img src=\"images/buttons/b_edit.png\" alt=\"Bearbeiten\" border=\"0\"></a></td>
             </tr>\n";
             $i=$i+1;
            }
           }
           echo "</small></table>";
           echo "<br>Anzahl der Treffer: ",$treffer,"<br>";
           if ($i == 1)
           {
            echo "<table>
            <tr>
            <td><h2>Leider nichts gefunden...</h2> </td>
            <td> <img src=\"images\error.jpg\" alt=\"\" border=\"0\" width=\"150\"></td>
            </tr>
            </table>";
           }
           nav_flur("alkgrund");
           bottom();
?>