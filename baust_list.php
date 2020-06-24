<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("baust_function.php");
$what=$_GET["what"];

head_baust();
nav_baust();


?>
<body>

<font face="Arial">


<div align="center">

<h2>Baustellen</h2>

<?php

  $query="SELECT box(the_geom) as box,was,wo,wer,wann,gid from fd_baustellen ORDER by $what";
  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $baust[$count]=$r;
    }
   


 echo "<table>
<tr>
<td"; if ($what == 'wo') echo " bgcolor=#D9D8DA "; echo " width=\"150\"><a href=\"baust_list.php?what=wo\">Wo</a></td>
<td"; if ($what == 'was') echo " bgcolor=#D9D8DA "; echo " width=\"150\"><a href=\"baust_list.php?what=was\">Was</a></td>
<td"; if ($what == 'wer') echo " bgcolor=#D9D8DA "; echo " width=\"150\"><a href=\"baust_list.php?what=wer\">Wer</a></td>
<td"; if ($what == 'wann') echo " bgcolor=#D9D8DA "; echo " width=\"120\"><a href=\"baust_list.php?what=wann\">Wann</a></td>
<td width=\"80\"></td>
<td></td>
</tr>


<tr><td colspan=\"6\"><hr></td></tr>";



  
for ($i=1;$i<=$count;$i++)
    {
  $id=$baust[$i][gid];
  $boxstring=$baust[$i][box];
  $klammern=array("(",")");
  $boxstring=str_replace($klammern,"",$boxstring);
  $koordinaten=explode(",",$boxstring);
  $rechts_range=$koordinaten[0]-$koordinaten[2];
  $rechts=$koordinaten[2]+($rechts_range/2);
  $hoch_range=$koordinaten[1]-$koordinaten[3];
  $hoch=$koordinaten[3]+($hoch_range/2);
  $range=$hoch_range;
  if ($rechts_range > $hoch_range) $range=$rechts_range;
  $range=$range+4000;
  $name=$baust[$i][was];
  $wo=$baust[$i][wo];
     $link=URL."kva/"."baust_map.php?rechts=$rechts&hoch=$hoch&range=$range&name=$name&kopf=0";

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$baust[$i][wo],"</td>
     <td>",$baust[$i][was],"</td>
     <td>",$baust[$i][wer],"</td>
     <td>",$baust[$i][wann],"</td>";
     echo "<td><a href=\"$link \" target=\"about_blank\"><small>Zur Karte</small></a>
     </td>";
?>



     <td width=50 align=center><a href="baust_confirm.php?<?php echo "id=$id&what=$what";?>" ><img src="images/buttons/b_drop.png" alt="L&ouml;schen" border="0"></a></td>
 <?php  echo"</tr>";
    }

?>

</table>
</body>    