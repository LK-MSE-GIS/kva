<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("str_function.php");

head_str();
nav_str();
?>
<font face="Arial">
<div align="center">

<h2>Straßenschlüsselverwaltung</h2>
<br>
Gemeinde auswählen:

<form action="str_list.php" method="post" target="">
<input type=hidden name="postman" value="ja">
<select name="gemeinde" onChange='document.forms[0].submit()'>
 <?php
 $query="SELECT * FROM alb_v_gemeinden  ORDER BY gemeindename";
 $result = $dbqueryp($connectp,$query);

 while($r = $fetcharrayp($result))
   {
   echo "<option value=\"$r[gemeinde]\">$r[gemeindename]</option>\n";
   }
?>
</select>
<br>
<br>
<input type="Submit" name="" value="Suche starten">
</form>
</font>
<?php 
bottom();
?>