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

<h2>Status �ndern</h2>

<?php

  $query="SELECT oid as id,* from fd_bs where oid='$id'";
  $result = $dbqueryp($connectp,$query);
  $count=0;

  $r = $fetcharrayp($result);
   


echo"
<form action=\"bs_change.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">";
?>

<table>
<tr>
<td width="150">Bezeichnung</td>
<td width="150">Erstsch.</td>
<td width="150">Nachsch.</td>
<td width="200">Status</td>
</tr>


<tr><td colspan="6"><hr></td></tr>


<?php
  

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$r[bezeichnung],"</td>
     <td>",$r[erstsch],"</td>
     <td>",$r[nachsch],"</td>";
     
   echo "<td>
      <select name=\"status\">
   <option";
    if($r[status]=="keine Aktion")
    {
    echo " selected";
    }
    echo " value=\"keine Aktion\">keine Aktion</option>
   <option";
   if($r[status]=="bei Vermessungsstelle")
    {
    echo " selected";
    }
    echo " value=\"bei Vermessungsstelle\">bei Vermessungsstelle</option>
   <option";
   if($r[status]=="Eingangspr�fung")
    {
    echo " selected";
    }
    echo " value=\"Eingangspr�fung\">Eingangspr�fung</option>
   <option";
   if($r[status]=="in ALK ohne NS und GL")
    {
    echo " selected";
    }
    echo " value=\"in ALK ohne NS und GL\">in ALK ohne NS und GL</option>
    <option";
   if($r[status]=="in ALk �bernommen vollst�ndig")
    {
    echo " selected";
    }
    echo " value=\"in ALk �bernommen vollst�ndig\">in ALK �bernommen vollst�ndig</option>

   </select>
   </td>";
     echo "<td><input type=\"Submit\" name=\"\" value=\"Status �ndern\">
     </td>";
   echo"</tr>";


?>
</form>
</table>
</body>    