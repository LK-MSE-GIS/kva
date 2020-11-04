<?php

include("connect.php");
include("function.php");

xhead_ant();
xmain_nav();
xnav_ant();
?>

<form action="xant_statistik.php" method="post" target="">
<div align="center">
<h3>Statistik der Antragsdatenbank</h3>

Für welche Vermessungsstelle soll die Statistik durchgeführt werden?<br>
(Bei Angabe keiner Vermessungsstelle werden alle mit einbezogen)<br>
<br>
<select name="vermst_id">
 <?php
 $query="SELECT * FROM vermst ORDER BY vermst";
 $result=mysqli_query($db_link,$query);

 while($r=mysqli_fetch_array($result))
   {
   echo "<option value=\"$r[vermst_id]\">$r[vermst]</option>\n";
   }
?>
</select><br>
<br>
<input type="Submit" name="" value="Statistik starten">
</div>
</form>
<?php
xnav_ant();
bottom();
?>