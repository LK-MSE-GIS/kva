<?php
include ("connect.php");
include ("li_function.php");

$id=$_GET["id"];

head_li_balk();
echo "<div align=\"center\"><h3>Datensatz l&ouml;schen</h3></div>";
$query="SELECT * from li_balk where id=$id;";
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
   <td>$r[date]</td>
   </tr>";
  }
 echo "</table>";

 echo "<br><div align =\"center\">Soll dieser Datensatz gel&ouml;scht werden?<br><br><a href=\"li_balk_del2.php?id=$id\">Ja</a>&nbsp;&nbsp;<a href=\"li_balk_search.php\">Nein</a></div>";
bottom();
?>