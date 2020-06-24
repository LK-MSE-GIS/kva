<?php

include("connect.php");
include("function.php");

head_ant();
nav_ant();
?>

<form action="ant_statistik.php" method="post" target="">
<div align="center">
<h3>Statistik der Antragsdatenbank</h3>

F&uuml;r welche Vermessungsstelle soll die Statistik durchgeführt werden?<br>
(Bei Angabe keiner Vermessungsstelle werden alle mit einbezogen)<br>
<br>
<select name="vermst_id">
 <?php
 $query="SELECT * FROM vermst ORDER BY vermst";
 $result=mysql_query($query,$db_link);

 while($r=mysql_fetch_array($result))
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
nav_ant();
bottom();
?>