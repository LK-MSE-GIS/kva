<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];

head_li_a();
echo "<div align=\"center\"><h3>Datensatz l&ouml;schen</h3></div>";
$query="SELECT * from li_a where id=$id;";
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
   <td valign=\"top\">$r[antrag]</td>
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
   </td>
   <td valign=\"top\">$r[take_date]<br><small>";
     $query3="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[take_mit_id]";
     $result3=mysql_query($query3);
     $r3=mysql_fetch_array($result3);
     echo"$r3[name]</small>
   </td>
   </tr>";
  }
 echo "</table>";
 echo "<br><div align =\"center\">Soll dieser Datensatz gel&ouml;scht werden?<br><br><a href=\"li_a_del2.php?id=$id\">Ja</a>&nbsp;&nbsp;<a href=\"li_a_search.php\">Nein</a></div>";
bottom();
?>