<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];

head_li_b();
echo "<div align=\"center\"><h3>Datensatz l&ouml;schen</h3></div>";
$query="SELECT * from li_b where id=$id;";
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
 echo "<br><div align =\"center\">Soll dieser Datensatz gel&ouml;scht werden?<br><br><a href=\"li_b_del2.php?id=$id\">Ja</a>&nbsp;&nbsp;<a href=\"li_b.php\">Nein</a></div>";
bottom();
?>