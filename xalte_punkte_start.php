<?php
include ("connect.php");
include ("function.php");

xhead_ant();
xmain_nav();

?>
<div class="ausgabe_bereich">
<font face="Arial"><h1>alte Punktreservierungen</h1><br>
übernommen aus der UNIPLEX-Datenbank&nbsp;&nbsp;&nbsp;&nbsp;
</font>
</div>

<div class="ausgabe_bereich">
<form action="xalte_punkte_list.php" method="post" target="">
Kilometerquadrat auswählen:&nbsp;
<?php
    echo "<select name=\"kmq\">";

   $query="SELECT kmq from punktnummern GROUP BY kmq ORDER BY kmq";
   $result=mysqli_query($db_link,$query);

   while($r=mysqli_fetch_array($result))
     {
     echo "<option value=\"$r[kmq]\">$r[kmq]</option>\n";
      }

    echo "</select>";
?>


<input type="Submit" name="" value="Weiter">
</form>   
</div>

<?php


bottom();
?>