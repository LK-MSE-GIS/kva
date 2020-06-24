<?php
include ("connect.php");
include ("function.php");

$dateiname=$_POST["dateiname"];
$tmpname=$_FILES['$dateiname']['tmp_name'];


echo "<h1>Migration Rissnummern</h1>";

$handle = fopen($_FILES['dateiname'][tmp_name],"r");

while (!feof($handle)) {
    $buffer = fgets($handle, 50);


    $teile = explode(";", $buffer);
    $antrag_id=substr($teile[1],0,4);
    if ($antrag_id != "")
    {
     echo "Rissnummer:$teile[0]&nbsp;Antrag:$antrag_id<br>";
     $query="update antrag set riss='$teile[0]' where id='$antrag_id';";
     echo $query,"<br>";
     mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
     }
}
fclose ($handle);
?>
<br>
<br>

<a href="rissnummern.html">Zum Start</a>
