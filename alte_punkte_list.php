<?php
include ("connect.php");
include ("function.php");

$kmq=$_POST["kmq"];

head_ant();

?>

<font face="Arial"><h3><?php echo $kmq; ?></h3>
übernommen aus der UNIPLEX-Datenbank<br>

<?php
echo "<table>
      <tr>
      <td width=\"150\">von</td>
      <td width=\"150\">bis</td>
      <td width=\"550\">Kommentar</td>
      </tr>
      <tr><td colspan=\"3\"><hr></td></tr>";

$query="SELECT * FROM punktnummern WHERE kmq='$kmq'";
$result=mysql_query($query);
while($r=mysql_fetch_array($result))
  {
    echo "<tr>
          <td>$r[von]</td>
          <td>$r[bis]</td>
          <td>$r[comment]</td>
          </tr>";
   }

?>
</font>