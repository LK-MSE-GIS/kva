<?php
include ("connect_pgsql.php");


?>

<font face="Arial"><h1>Bodenrichtwertzonen</h1>
<form action="brw_gemeinde.php" method="post" name="Formular1" >
<table>
<tr>
<td width=200>Stichtag:</td>
<td>
 <?php
 $query="SELECT DISTINCT stichtag FROM bw_zonen ORDER BY stichtag";
 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   echo "<input name=\"stichtag\" type=radio value=\"$r[stichtag]\"";
   if ($r[stichtag]=='2010-12-31') echo " checked";
   echo ">$r[stichtag]<br>";
   }
?>
</td>
</tr>
</table>
<br>
<br>

<table border="0" style="font-family:Arial; font-size: 10pt; font-weight: italic">
<tr bgcolor="#80FF00">
<td width=200>Gemeinde auswählen::</td>
<td> <select name="gemeinde_id" onChange='document.forms[0].submit()'>
 <?php
 $query="SELECT * FROM alb_v_gemeinden ORDER BY gemeindename";
 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   echo "<option value=\"$r[gemeinde]\">$r[gemeindename]</option>\n";
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