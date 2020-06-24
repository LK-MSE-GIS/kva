<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$os_array=array("2300","2390","2690","2900","2910","2920","2990","3000","4000","5000","5800","5840",
"6000","7000","8000","9200","9240","9290");


echo "<font face=\"Arial\"><h2>Nicht migrierbare Nutzungsarten</h2><br>";

echo "<table>
<tr>
<td width=\"120\">Schlüssel</td>
<td>Bezeichnung</td>
<td align=\"right\" width=\"120\">Häufigkeit</td>
</tr>
<tr><td colspan=\"3\"><hr></td></tr>";

for ($i=0;$i<=17;$i++)
{

$os=$os_array[$i];
$query="SELECT * from oska_mv WHERE folie='021' AND objart='$os'";
  $result = $dbqueryp($connectp,$query);
  $r = $fetcharrayp($result);
  $bez=$r[bezeichnung];
$query="SELECT * from alkobj_e_fla WHERE folie='021' AND objart='$os'";
  $result = $dbqueryp($connectp,$query);
  $count=0;
  while($r = $fetcharrayp($result))
    {
     $count++;
    }
echo "<tr>
      <td>$os</td>
      <td>$bez</td>
      <td align=\"right\"><a href=\"flur_statistik_nutz_list.php?os=$os\">$count</a></td>
      </tr>";
}


echo "</table><br><br>";


nav_flur("alkgrund");
bottom();
?>