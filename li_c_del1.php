<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];

head_li_c();
echo "<div align=\"center\"><h3>Datensatz l&ouml;schen</h3></div>";
$query="SELECT * from li_c where id=$id;";
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
     echo "</tr>";

  }
 echo "</table>";
 echo "<br><div align =\"center\">Soll dieser Datensatz gel&ouml;scht werden?<br><br><a href=\"li_c_del2.php?id=$id\">Ja</a>&nbsp;&nbsp;<a href=\"li_c.php\">Nein</a></div>";
bottom();
?>