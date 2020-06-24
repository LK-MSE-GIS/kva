<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("baust_function.php");

$id = $_GET["id"];

head_baust();
nav_baust();


?>
<body>

<font face="Arial">


<div align="center">

<h2>Status ändern</h2>

<?php

  $query="SELECT oid as id,box(the_geom) as box,bezeichnung,vermessungsstelle,abgabe,status from fd_wv where oid='$id'";
  $result = $dbqueryp($connectp,$query);
  $count=0;

  $r = $fetcharrayp($result);
   


echo"
<form action=\"wv_change.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">";
?>

<table>
<tr>
<td width="150">Bezeichnung</td>
<td width="150">ÖbVI</td>
<td width="150">Datum</td>
<td width="200">Status</td>
</tr>


<tr><td colspan="6"><hr></td></tr>


<?php
  

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$r[bezeichnung],"</td>
     <td>",$r[vermessungsstelle],"</td>
     <td>",$r[abgabe],"</td>";
     
   echo "<td>
      <select name=\"status\">
   <option";
    if($r[status]=="0")
    {
    echo " selected";
    }
    echo " value=\"0\">bei Verm.-Stelle</option>
   <option";
   if($r[status]=="1")
    {
    echo " selected";
    }
    echo " value=\"1\">bereit zur Übernahme</option>
   <option";
   if($r[status]=="2")
    {
    echo " selected";
    }
    echo " value=\"2\">ALB-Übernahme</option>
   <option";
   if($r[status]=="3")
    {
    echo " selected";
    }
    echo " value=\"3\">abgeschlossen</option>

   </select>
   </td>";
     echo "<td><input type=\"Submit\" name=\"\" value=\"Status ändern\">
     </td>";
   echo"</tr>";


?>
</form>
</table>
</body>    