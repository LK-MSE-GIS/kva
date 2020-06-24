<?php
include ("connect.php");
include ("function.php");
?>
<body bgcolor="#000000" text="#FCFDBF">
<form action="baustelle_insert.php" method="post" target="">
<table>
<tr style="font-family:Arial; font-size: 12pt; font-weight: bold">
<td>Mitarbeiter</td>
<td>Gemarkung</td>
<td>Flur/Flst.</td>
<td>Art</td>
</tr>
<tr>
<?php
echo "<td><select name=\"mit_id\">";

 $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%bau%'";
 $result2=mysql_query($query2);

 while($r2=mysql_fetch_array($result2))
   {
   echo "<option value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
   }
   echo "</select>
   </td>";
?>
<td>
<select name="gem_id">
 <?php
 $query="SELECT * FROM gemarkung WHERE gemark_id < 139999 ORDER BY gemarkung";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
   }
?>
</select>
</td>
<td><input type="Text" name="flur" value="" size="15" maxlength="15"></td>
<td>
<select name="baust_art">
 <?php
 $query="SELECT * FROM baustellenart ORDER BY id";
 $result=mysql_query($query);

 while($r=mysql_fetch_array($result))
   {
   echo "<option value=\"$r[id]\">$r[art]</option>\n";
   }
?>
</select>
</td>
</tr>
</table>
<br>
<input type="Submit" name="" value="Neue Baustelle eintragen">&nbsp;&nbsp;<input type="reset">
</form>

<?php
bottom();
?>