<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();

$id=$_POST["id"];

$query="SELECT * FROM antrag WHERE id = '$id';";

$result=mysql_query($query,$db_link);

echo"
<table border=\"1\" >
<tr>
 <td colspan=\"6\">Antrag </td>
</tr>
<tr bgcolor=\"#80FFFF\">
 <td>ID</td>
 <td>Vermessungsstelle</td>
 <td>Gemarkung</td>
 <td>Eingangsdatum</td>
 <td width=\"100\">&nbsp;</td>
 <td width=\"100\">&nbsp;</td>
 </tr>\n";

while($r=mysql_fetch_array($result))
  {
  echo"
  <tr>
  <td>$r[id]</td>
  <td>";
     $query3="SELECT * FROM vermst WHERE vermst_id=$r[vermst_id]";
     $result3=mysql_query($query3,$db_link);
     $r3=mysql_fetch_array($result3);
     echo"$r3[vermst]
  </td>
  <td>";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[gemark_id]";
     $result4=mysql_query($query4,$db_link);
     $r4=mysql_fetch_array($result4);
     echo"$r4[gemarkung]
  </td>
  <td>$r[eing_datum]</td>
  <td><a href=\"vermst_aendern.php?vermst_id=$r[vermst_id]\">Bearbeiten</a></td>
  <td><a href=\"vermst_loeschen.php?vermst_id=$r[vermst_id]\">L&ouml;schen</a></td>
  </tr>\n";
  }

echo "</table>";
nav_ant();
bottom();
?>