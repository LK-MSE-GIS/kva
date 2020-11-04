<?php
include ("connect.php");
include ("function.php");

$kmq=$_POST["kmq"];

xhead_ant();
xmain_nav();

?>

<div class="ausgabe_bereich">
<font face="Arial"><h3><?php echo $kmq; ?></h3>
übernommen aus der UNIPLEX-Datenbank<br>
</div>

<div class="ausgabe_bereich">
<?php
echo "<table>
      <tr>
      <td width=\"150\">von</td>
      <td width=\"150\">bis</td>
      <td width=\"550\">Kommentar</td>
      </tr>
      <tr><td colspan=\"3\"><hr></td></tr>";

$query="SELECT * FROM punktnummern WHERE kmq='$kmq'";
$result=mysqli_query($db_link,$query);
while($r=mysqli_fetch_array($result))
  {
    echo "<tr>
          <td>$r[von]</td>
          <td>$r[bis]</td>
          <td>$r[comment]</td>
          </tr>";
   }

?>
</font></div>