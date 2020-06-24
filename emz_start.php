<?php
include ("connect_pgsql.php");


?>

<font face="Arial"><h1>Ermittlung der Bodenwertzahlen</h1>

<form action="emz_flur.php" method="post" name="Formular1" >
<table border="0" style="font-family:Arial; font-size: 10pt; font-weight: italic">
<tr bgcolor="#80FF00">
<td width=200>Gemarkung auswählen::</td>
<td> <select name="gemkg_id" onChange='document.forms[0].submit()'>
 <?php
 $query="SELECT * FROM alb_v_gemarkungen ORDER BY gemkgname";
 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   echo "<option value=\"$r[gemkgschl]\">$r[gemkgname]</option>\n";
   }
?>
</select></td>
<td bgcolor="#80FF00"> <input type="Submit" name="" value="Weiter"></td>
</tr>


</table>
</form>

<br>
<br>



<?php


?>