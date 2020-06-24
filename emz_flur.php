<?php
include ("connect_pgsql.php");
$gemkgschl=$_POST["gemkg_id"];

?>

<font face="Arial"><h1>Ermittlung der Bodenwertzahlen</h1>

<form action="emz_flst.php" method="post" name="Formular1" >
<table border="0" style="font-family:Arial; font-size: 10pt; font-weight: italic">
<tr style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td width=200>Gemarkung:</td>
<td> 
 <?php
 $query="SELECT * FROM alb_v_gemarkungen WHERE gemkgschl='$gemkgschl'";
 $result = $dbqueryp($connectp,$query);
 $r = $fetcharrayp($result);
 echo "<b>$r[gemkgname]</b>";
 echo "<input type=hidden name=\"gemkgname\" value=\"$r[gemkgname]\">";
?>

<td>
</tr>
 
<tr bgcolor="#80FF00">
<td>Flur auswählen:</td>
<td> <select name="flur_id" onChange='document.forms[0].submit()'>
 <?php
 
 $query="SELECT flur FROM alknflur WHERE gemkgschl = '$gemkgschl' AND flur != '000' ORDER BY flur";


 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   $identifier=$gemkgschl."-".$r[flur];
   echo "<option value=\"$identifier\">$r[flur]</option>\n";
   }
?>
</select></td><td width=100 align=right><input type="Submit" name="" value="Weiter" ></td>
</tr>


</table>

</form>

<br>
<br>



<?php


?>