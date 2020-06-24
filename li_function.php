<?php

    $datum = getdate(time());
    $year=$datum[year];
	
    $month=$datum[mon];
	
    $day=$datum[mday];

    $hour=$datum[hours];
    $min=$datum[minutes];
    $sec=$datum[seconds];

    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($hour) == 1) $hour='0'.$hour;
    if (strlen($min) == 1) $min='0'.$min;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$year."-".$month."-".$day;



function head_li_balk()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    ALB-Listen
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\">
  <font face=\"Arial\">
  <table>
  <tr>
  <td><a href=\"li_a.php\">[A-Liste]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_b.php\">[B-Liste]</a>&nbsp;&nbsp;</td>
  <td><b>B-Liste (Abgleich ALK-ALB)</b>&nbsp;&nbsp;</td>
  <td><a href=\"li_c.php\">[C-Liste]</a>&nbsp;&nbsp;</td>
  </tr>
  </table>
 <hr style=\"color:#16CD4E; background: red; height:8px; \">
<table boder=\"0\">
<tr>
<td><a href=\"li_balk_all.php?page=0\">[Alle Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_balk.php\">[Letzte Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_balk_new.php\">[Neuer Eintrag]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_balk_search.php\">[Suchen]</a></td>
<td>&nbsp;&nbsp;</td>
</tr>
</table><hr>";
}

function head_li_a()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    ALB-Listen
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\">
  <font face=\"Arial\">
<table>
  <tr>
  <td><b>A-Liste</b>&nbsp;&nbsp;</td>
  <td><a href=\"li_b.php\">[B-Liste]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_balk.php\">[B-Liste (Abgleich ALK-ALB)]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_c.php\">[C-Liste]</a>&nbsp;&nbsp;</td>
  </tr>
  </table>
  <hr style=\"color:#16CD4E; background: red; height:8px; \">
<table boder=\"0\">
<tr>
<td><a href=\"li_a_all.php?page=0&all=0\">[Alle Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_a.php\">[Letzte Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_a_new.php\">[Neuer Eintrag]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_a_search.php\">[Suchen]</a></td>
<td>&nbsp;&nbsp;</td>
</tr>
</table><hr>";
}


function head_li_c()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    ALB-Listen
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\">
  <font face=\"Arial\">
<table>
  <tr>
  <td><a href=\"li_a.php\">[A-Liste]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_b.php\">[B-Liste]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_balk.php\">[B-Liste (Abgleich ALK-ALB)]</a>&nbsp;&nbsp;</td>
  <td><b>C-Liste</b></td>
  </tr>
  </table>
   <hr style=\"color:#16CD4E; background: red; height:8px; \">
<table boder=\"0\">
<tr>
<td><a href=\"li_c_all.php?page=0&all=0\">[Alle Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_c.php\">[Letzte Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_c_new.php\">[Neuer Eintrag]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_c_search.php\">[Suchen]</a></td>
<td>&nbsp;&nbsp;</td>
</tr>
</table><hr>";
}

function head_li_b()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    ALB-Listen
  </title>
  </head>

  <body bgcolor=\"#FDFFEE\">
  <font face=\"Arial\">
<table>
  <tr>
  <td><a href=\"li_a.php\">[A-Liste]</a>&nbsp;&nbsp;</td>
  <td><b>B-Liste</b>&nbsp;&nbsp;</td>
  <td><a href=\"li_balk.php\">[B-Liste (Abgleich ALK-ALB)]</a>&nbsp;&nbsp;</td>
  <td><a href=\"li_c.php\">[C-Liste]</a>&nbsp;&nbsp;</td>
  </tr>
  </table>
 <hr style=\"color:#16CD4E; background: red; height:8px; \">
<table boder=\"0\">
<tr>
<td><a href=\"li_b_all.php?page=0&all=0\">[Alle Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_b.php\">[Letzte Eintr&auml;ge zeigen]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_b_new.php\">[Neuer Eintrag]</a></td>
<td>&nbsp;&nbsp;</td>
<td><a href=\"li_b_search.php\">[Suchen]</a></td>
<td>&nbsp;&nbsp;</td>
</tr>
</table><hr>";
}

function li_balk_page($page,$dbname,$query,$del)
 {
 $offset=$page*20;
 $query=$query." ORDER BY \"year\",\"number\" limit $offset,20;";
 $result=mysql_query($query);
echo "<table>
<tr>
<td width=\"100\">Jahrgang</td>
<td width=\"100\">Nummer</td>
<td width=\"160\">Gemarkung</td>
<td width=\"60\">Flur</td>
<td  width=\"200\">Mitarbeiter</td>
<td width=\"100\">Datum</td>
</tr>";
$i=0;
while($r=mysql_fetch_array($result))
  {
    $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
    if ($r[worry]=='1') $Farbe="#F56854";
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td>$r[year]</td>
   <td>$r[number]</td>
   <td>";
   $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
   </td>
   <td>$r[flur_id]</td>
   </td>
   <td>";
   $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mitarb_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]
   </td>
   <td>$r[date]</td>";
   if ($del == '1') echo "
   <td><a href=\"li_balk_del1.php?id=$r[id]\"><img src=\"images/buttons/b_drop.png\" alt=\"L&ouml;schen\" border=\"0\"></a></td>";
   echo "</tr>";
  }
 echo "</table>";
}

function li_a_page($page,$dbname,$query,$del,$edit)
 {
 $offset=$page*10;
 $query=$query." ORDER BY year,number limit $offset,10;";
 $result=mysql_query($query);
echo "<table>
<tr>
<td width=\"50\">Jahr</td>
<td width=\"80\">ALB-N</td>
<td width=\"112\">Antrag</td>
<td width=\"240\">Flurst&uuml;ck</td>
<td width=\"240\">Verm.-art</td>
<td width=\"120\">V-Datum</td>
<td width=\"120\">E-Datum</td>
</tr>";
$i=0;
while($r=mysql_fetch_array($result))
  {
    $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td valign=\"top\">$r[year]</td>
   <td valign=\"top\">$r[number]</td>
   <td valign=\"top\">$r[antrag]";
   $azarray=explode("/",$r[antrag]);
   $aznumber=$azarray[0];
   if ($azarray[1] > 30) $azyear="19".$azarray[1];
    else $azyear="20".$azarray[1];
   $checkquery="SELECT id FROM antrag WHERE year='$azyear' AND number='$aznumber'";
  $checkresult=mysql_query($checkquery);
  if ($checkr=mysql_fetch_array($checkresult))
     {
     echo "&nbsp;<a href=\"ant_aendern_uebernahme.php?id=$checkr[id]\" target=\"about_blank\"><img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a>";
     }


   echo "</td>
   <td valign=\"top\">$r[flst1]";
   if ($r[flst2] != "") echo "<br>",$r[flst2];
   if ($r[flst3] != "") echo "<br>",$r[flst3];
   if ($r[flst4] != "") echo "<br>",$r[flst4];
   echo "</td>
   <td valign=\"top\">";
   $query1="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result1=mysql_query($query1);
     $r1=mysql_fetch_array($result1);
     echo"$r1[vermart]</td>
    <td valign=\"top\">$r[vorb_date]<br><small>";
   $query2="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[vorb_mit_id]";
     $result2=mysql_query($query2);
     $r2=mysql_fetch_array($result2);
     echo"$r2[name]</small>
   </td>";
   if (($r[take_date] != '0000-00-00') AND ($r[take_mit_id] != '0'))
    {

     echo "<td valign=\"top\">$r[take_date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[take_mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small></td>";
     }
     else
     {
     echo "<td align=\"center\"><a href=\"li_a_end.php?id=$r[id]\">eintragen</a></td>";
     }
     if ($edit == '1') echo "<td><a href=\"li_a_edit.php?id=$r[id]\"><img src=\"images/buttons/b_edit.png\" alt=\"bearbeiten\" border=\"0\"></a></td>";
     if ($del == '1') echo "
   <td><a href=\"li_a_del1.php?id=$r[id]\"><img src=\"images/buttons/b_drop.png\" alt=\"L&ouml;schen\" border=\"0\"></a></td>";
   echo "</tr>";

  }
 echo "</table>";
}

function li_c_page($page,$dbname,$query,$del,$edit)
 {
 $offset=$page*10;
 $query=$query." ORDER BY year,number limit $offset,10;";
 #echo $query;
 $result=mysql_query($query);
echo "<table>
<tr>
<td width=\"50\">Jahr</td>
<td width=\"80\">ALB-N</td>
<td width=\"112\">Bem.</td>
<td width=\"240\">Grundbuch</td>
<td width=\"240\">FA/Bem.</td>
<td width=\"120\">Datum</td>
</tr>";
$i=0;
while($r=mysql_fetch_array($result))
  {
    $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td valign=\"top\">$r[year]</td>
   <td valign=\"top\">$r[number]</td>
   <td valign=\"top\">$r[bem]</td>
   <td valign=\"top\">$r[grubu]</td>
   <td valign=\"top\">$r[fa_bem]</td>
   <td valign=\"top\">$r[date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small></td>";
     if ($edit == '1') echo "<td><a href=\"li_c_edit.php?id=$r[id]\"><img src=\"images/buttons/b_edit.png\" alt=\"bearbeiten\" border=\"0\"></a></td>";
     if ($del == '1') echo "
   <td><a href=\"li_c_del1.php?id=$r[id]\"><img src=\"images/buttons/b_drop.png\" alt=\"L&ouml;schen\" border=\"0\"></a></td>";
   echo "</tr>";

  }
 echo "</table>";
}

function li_b_page($page,$dbname,$query,$del,$edit)
 {
 $offset=$page*10;
 $query=$query." ORDER BY year,number limit $offset,10;";
 $result=mysql_query($query);
echo "<table>
<tr>
<td width=\"50\">Jahr</td>
<td width=\"80\">ALB-N</td>
<td width=\"112\">FMA</td>
<td width=\"240\">Flurst&uuml;cke(e)</td>
<td width=\"240\">FA/Bem.</td>
<td width=\"120\">Datum</td>
</tr>";
$i=0;
while($r=mysql_fetch_array($result))
  {
    $i++;
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
   echo" <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
   <td valign=\"top\">$r[year]</td>
   <td valign=\"top\">$r[number]</td>
   <td valign=\"top\">$r[fma]</td>
   <td valign=\"top\">$r[flst]</td>
   <td valign=\"top\">$r[fa_bem]</td>
   <td valign=\"top\">$r[date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small></td>";
     if ($edit == '1') echo "<td><a href=\"li_b_edit.php?id=$r[id]\"><img src=\"images/buttons/b_edit.png\" alt=\"bearbeiten\" border=\"0\"></a></td>";
     if ($del == '1') echo "
   <td><a href=\"li_b_del1.php?id=$r[id]\"><img src=\"images/buttons/b_drop.png\" alt=\"L&ouml;schen\" border=\"0\"></a></td>";
   echo "</tr>";

  }
 echo "</table>";
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

function bottom()
  {
  echo "</font></body> </html>";
  }

function li_count($dbname,$query)
  {
   $result=mysql_query($query);
   $anz=0;
   while($r=mysql_fetch_array($result))
    {
     $anz++;
    }
   return $anz;
  }
?>