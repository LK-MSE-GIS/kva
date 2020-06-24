<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$os=$_GET["os"];

$query="SELECT * from oska_mv WHERE folie='021' AND objart='$os'";
  $result = $dbqueryp($connectp,$query);
  $r = $fetcharrayp($result);
  $bez=$r[bezeichnung];

echo "<font face=\"Arial\"><h3>$os-$bez</h3><br>";

echo "<table>
<tr>
<td width=\"120\">Nr.</td>
<td width=\"120\">Schlüssel</td>
<td>Objektnummer</td>
</tr>
<tr><td colspan=\"3\"><hr></td></tr>";

$query="SELECT * from alkobj_e_fla WHERE folie='021' AND objart='$os'";
  $result = $dbqueryp($connectp,$query);
  $count=0;
  while($r = $fetcharrayp($result))
    {
     $count++;
     echo "<tr>
           <td>$count</td>
           <td>$os</td>
           <td>$r[objnr]</td>
           </tr>";
    }


echo "</table><br><br>
<a href=\"flur_statistik_nutzung.php\">Zurück zur Nutzungsartenstatistik</a><br><br>";


nav_flur("alkgrund");
bottom();
?>