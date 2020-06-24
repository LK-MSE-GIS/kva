<?php

include("connect.php");
include("function.php");


$gemark_id=$_GET["gemark_id"];
$flur_id=$_GET["flur_id"];

if ($flur_id != "") $query="SELECT * FROM antrag WHERE ((gemark_id_1 ='$gemark_id' AND flur_1 = '$flur_id') OR (gemark_id_2 ='$gemark_id' AND flur_2 = '$flur_id') OR (gemark_id_3 ='$gemark_id' AND flur_3 = '$flur_id')) AND ((aktort_id ='1' OR aktort_id = '2' OR aktort_id = '3' OR aktort_id = '4' OR aktort_id = '5' OR aktort_id = '6' OR aktort_id = '10')) ORDER by year,number;";
  else
  $query="SELECT * FROM antrag WHERE (gemark_id_1 ='$gemark_id' OR gemark_id_2 ='$gemark_id' OR gemark_id_3 ='$gemark_id') AND (aktort_id ='1' OR aktort_id = '2' OR aktort_id = '3' OR aktort_id = '4' OR aktort_id = '5' OR aktort_id = '6' OR aktort_id = '10') ORDER by year,number;";



$result=mysql_query($query,$db_link);
echo"
<table border=\"0\" bordercolor=\"#000000\" >
<tr>
 <td colspan=\"6\" align=\"left\"><input type=button value=\"Drucken\" onClick='window.print()'></td>
</tr>
<tr>
 <td style=\"font-family:Arial; font-size: 12pt\" colspan=\"6\" align=\"center\">Liste der in Arbeit befindlichen Auftr&auml;ge </td>
</tr>
<tr>
 <td style=\"font-family:Arial; font-size: 12pt\" colspan=\"6\" align=\"center\">",get_gemark_name($gemark_id,$dbname),"&nbsp;&nbsp;Flur:$flur_id&nbsp;&nbsp;Stand:&nbsp;$german_date</td>
</tr>
<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:5px; \"></td></tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td rowspan=\"2\" width=\"35\">Antrag</td>
 <td width=\"200\">Vermessungsstelle</td>
 <td width=\"150\">Gemarkung</td>
 <td width=\"60\">Flur</td>
 <td width=\"90\">Flst.(alt)</td>
 <td rowspan=\"2\" width=\"100\">Status</td>
 </tr>
 <tr style=\"font-family:Arial; font-size: 10pt\">
 <td >Vermessungsart </td>
 <td>Sachverhalt </td>
 <td><small>$tabtext</small></td>
 <td>Aktenort</td>
</tr>
<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:5px; \"></td></tr>
<small>";
$i=1;
while($r=mysql_fetch_array($result))
  {
    $xquery="SELECT * from antrag_extra where id = $r[id]";
    $xresult=mysql_query($xquery);
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
  <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td rowspan=\"2\" align=\"center\" valign=\"top\">$aktenz&nbsp;&nbsp;";
  if ($r[hurry] == "1") echo "&nbsp;<br>(eilig)&nbsp;";
  echo "</td> <td>";
     $query3="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[vermst]
  </td>
  <td>";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_1]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]&nbsp;($r[gemark_id_1])";
     if ($r[gemark_id_2] > 0)
        {
        $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_2]";
        $result4=mysql_query($query4);
        $r4=mysql_fetch_array($result4);
        echo"<br>$r4[gemarkung]&nbsp;($r[gemark_id_2])";
        }
     if ($r[gemark_id_3] > 0)
        {
        $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id_3]";
        $result4=mysql_query($query4);
        $r4=mysql_fetch_array($result4);
        echo"<br>$r4[gemarkung]&nbsp;($r[gemark_id_2])";
        }
  echo "</td>
  <td>$r[flur_1]";
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
  echo "<td><small>G</small>&nbsp;</td>";
  echo "<td><small>V</small></td>
  <td><small>M</small></td>
  <td><small>&Uuml;</small></td>
  <td><small>R</small></td>
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
    if ($r[aktort_id] == '8') echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"5\" width=\"95\" align=\"center\" bgcolor=\"#FF0000\">storniert</td></tr>";
    if (($checksum ==5) AND ($r[aktort_id] != '8')) echo "<tr  style=\"font-family:Arial; font-size: 9pt; font-weight: bold\"><td colspan=\"5\" width=\"95\" bgcolor=\"#00FF00\" align=\"center\">erledigt</td></tr>";
  }
  echo "</table>";
  }

  echo "</td>

  </tr>\n
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt\">
 <td>";
     $query8="SELECT * FROM vermart WHERE vermart_id=$r[vermart_id]";
     $result8=mysql_query($query8);
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
   else echo" <td>$r[$datart]</td>";

  echo "<td>";
     $query5="SELECT * FROM aktort WHERE aktort_id=$r[aktort_id]";
     $result5=mysql_query($query5);
     $r5=mysql_fetch_array($result5);
     echo"$r5[aktort]
 </td>
</tr>
<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:2px; \"></td></tr>";
$i=$i+1;
}

echo "</small></table>";


bottom();
?>