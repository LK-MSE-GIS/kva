<?php
include ("connect.php");
include ("function.php");

$dateiname=$_GET["dateiname"];
$kmq=$_GET["kmq"];

echo "<h3>Import Punktnummern $kmq</h3>";

$query="SELECT * FROM punktnummern WHERE kmq='$kmq'";
$result=mysql_query($query);
$check=0;
while($r=mysql_fetch_array($result))
  {
    $check++;
   }

if ($check > 0)
  {
   echo "Dieses KMQ ist schon importiert worden.<br>
   <br>";
   }
   else
   {

     $handle = fopen ("$dateiname", "r");
     $i=1;
      echo "<table>
      <tr>
      <td>von</td>
      <td>bis</td>
      <td>Kommentar</td>
      </tr>";

     while (!feof($handle))
      {
       $buffer = fgets($handle, 150);
       if (($buffer[5] >= '0' AND $buffer[5] <= '9') OR ($buffer[13] >= '0' AND $buffer[13] <= '9'))
      {
      for ($j=0;$j<=strlen($buffer);$j++)
           if ($buffer[$j] == '\'') $buffer[$j]=" ";
      $von=substr($buffer,1,5);
      $bis=substr($buffer,9,5);
      if ($von == '     ') $von=$bis;
      if ($bis == '     ') $bis=$von;
      $comment=substr($buffer,16,50);
      echo "<tr>
           <td>$von</td>
           <td>$bis</td>
           <td>$comment</td>
            </tr>";


        $query="INSERT INTO punktnummern (kmq,von,bis,comment) VALUES ('$kmq','$von','$bis','$comment')";
     mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

   $i++;
      }
   }
  echo "</table>";
  fclose ($handle);
  }

?>
<br>
<br>

<a href="punktnummern.php">Import</a>