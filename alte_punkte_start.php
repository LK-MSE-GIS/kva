<?php
include ("connect.php");
include ("function.php");

head_ant();

?>

<font face="Arial"><h1>alte Punktreservierungen</h1><br>
übernommen aus der UNIPLEX-Datenbank&nbsp;&nbsp;&nbsp;&nbsp;
<a href="punktnummern.php">Import</a></font>

<form action="alte_punkte_list.php" method="post" target="">
Kilometerquadrat auswählen:&nbsp;
<?php
    echo "<select name=\"kmq\">";

   $query="SELECT kmq from punktnummern GROUP BY kmq ORDER BY kmq";
   $result=mysql_db_query($dbname,$query);

   while($r=mysql_fetch_array($result))
     {
     echo "<option value=\"$r[kmq]\">$r[kmq]</option>\n";
      }

    echo "</select>";
?>
    

<input type="Submit" name="" value="Weiter">
</form>

<?php


bottom();
?>