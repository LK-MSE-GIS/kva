<?php

include("connect.php");
include("function.php");


$searchquery="SELECT * from ant_search where mitarb_id='$mitarb_id';";
$antresult=mysql_query($searchquery,$db_link);
$ant_r=mysql_fetch_array($antresult);
$query=$ant_r[query];
$tabtext=$ant_r[tabtext];
$datart=$ant_r[datart];
$gemark=$ant_r[gemark_id];
$flur=$ant_r[flur_id];

$query=$query.";";

$result=mysql_query($query,$db_link);
echo"<input type=button value=\"Drucken\" onClick='window.print()'><br>
<br>

<table border=\"0\" bordercolor=\"#000000\" >
<tr>
 <td style=\"font-family:Arial; font-size: 16pt\" colspan=\"6\" align=\"center\">Inhaltsverzeichnis&nbsp;",get_gemark_name($gemark,$dbname);
 if ($flur !="") echo " Flur:",$flur;
 echo "</td>
</tr>
<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:5px; \"></td></tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td width=\"35\"><small>Landkreis</small><br>
 Antrag<br>
 <small>&Auml;N</small></td>
 <td width=\"50\">Flur</td>
 <td width=\"200\">Flst. (alt)</td>
 <td width=\"200\">Flst. (neu)</td>
 <td width=\"90\">Riss</td>
 <td width=\"100\">Datum</td>
 </tr>

<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:5px; \"></td></tr>";
$i=1;
while($r=mysql_fetch_array($result))
  {
    $aktenz=$r[number]."/".substr($r[year],2,2);
    $lk=landkreis($r[lk]);
	

	
    echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
          <td align=\"left\" valign=\"top\" ><small>$lk</small><br>
  $aktenz<br><small>$r[ueb_aen]</small></td><td colspan=3 valign=top><table border=0>";
  
  
     if ($gemark ==$r[gemark_id_1])
     {
       echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
	        <td width=50 valign=top>$r[flur_1]</td>
            <td width=\"200\" valign=top>";
            get_flst($r[flst_1alt]);
            echo "</td><td width=\"200\" valign=top>";
            get_flst($r[flst_1]);
            echo "</td></tr>";
      }      

     if ($gemark ==$r[gemark_id_2])
     {
       echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
	         <td width=50 valign=top>$r[flur_2]</td>
            <td width=\"200\" valign=top>";
            get_flst($r[flst_2alt]);
            echo "</td><td width=\"200\" valign=top>";
            get_flst($r[flst_2]);
            echo "</td></tr>";
      }

      if ($gemark ==$r[gemark_id_3])
     {
       echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
	        <td width=50 valign=top>$r[flur_3]</td>
            <td width=\"200\" valign=top>";
            get_flst($r[flst_3alt]);
            echo "</td><td width=\"200\" valign=top>";
            echo "</td><td width=\"200\" valign=top>";
            get_flst($r[flst_3]);
            echo "</td></tr>";
      }      
     echo "</table></td>";
     $rissquery="SELECT riss_id from risse2antrag WHERE antrag_id='$r[id]' AND gemark_id='$gemark'";
	 $rissresult=mysql_query($rissquery,$db_link);
	 echo "<td valign=top>";
	 while($risse=mysql_fetch_array($rissresult))
      { 
	    echo "$risse[0]<br>";
	  }
	  echo "</td><td valign=top>$r[ueb_datum]</td></tr>";
	  
 
echo "
<tr><td colspan=\"6\"><hr style=\"color:#000000; background: red; height:2px; \"></td></tr>";
$i=$i+1;
}

echo "</table>";


bottom();
?>