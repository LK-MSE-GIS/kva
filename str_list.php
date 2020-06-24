<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("str_function.php");

head_str();
nav_str();
$postman=$_POST["postman"];
$gemeinde=0;
if ($postman == "ja") 
  {
   $gemeinde=$_POST["gemeinde"];
   $dir="";
  }


$order="strassenname";


if ($gemeinde == '0')
  {
   $gemeinde=$_GET["gemeinde"];
   $dir=$_GET["dir"];
   $order=$_GET["order"];
 if($dir=="")
  {
  $dir="DESC";
  }
  else
  {
  $dir="";
  }
  }

 $query="SELECT * FROM alb_v_gemeinden  WHERE gemeinde=$gemeinde";
 $result = $dbqueryp($connectp,$query);
 $r = $fetcharrayp($result);

?>
<body>

<font face="Arial">


<div align="center">

<h2>Straßenschlüssel Gemeinde <?php echo $r[gemeindename]; ?></h2>

<?php

  $query="SELECT a.gemeinde,f.gemkgschl,a.strasse,v.strassenname,g.gemkgname FROM alb_f_adressen AS a,alb_flurstuecke AS f,
alb_v_strassen as v, alb_v_gemarkungen as g WHERE a.flurstkennz=f.flurstkennz AND a.gemeinde = '$gemeinde' AND (a.gemeinde = v.gemeinde AND a.strasse = v.strasse) AND f.gemkgschl = g.gemkgschl 
GROUP BY a.gemeinde,f.gemkgschl,a.strasse,v.strassenname,g.gemkgname  ORDER BY $order $dir;";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $str[$count]=$r;
    }
   
?>

<table>
<tr>
<td width="350"><?php echo "<a href=\"str_list.php?gemeinde=$gemeinde&order=strassenname&dir=$dir\">Straße</a>";
if ($order =='strassenname')
  {
    if ($dir == 'DESC') echo " <img src=\"images/buttons/nach_unten.png\" alt=\"\" border=\"0\" width=\"20\">";
    if ($dir == '') echo " <img src=\"images/buttons/nach_oben.png\" alt=\"\" border=\"0\" width=\"20\">";
  }
?></td>
<td width="150"><?php echo "<a href=\"str_list.php?gemeinde=$gemeinde&order=strasse&dir=$dir\">Schlüssel</a>";
if ($order =='strasse')
  {
    if ($dir == 'DESC') echo " <img src=\"images/buttons/nach_unten.png\" alt=\"\" border=\"0\" width=\"20\">";
    if ($dir == '') echo " <img src=\"images/buttons/nach_oben.png\" alt=\"\" border=\"0\" width=\"20\">";
  }
?></td>
<td>Gemarkung</td>
</tr>
<tr><td colspan="3"><hr></td></tr>

<?php
  
for ($i=1;$i<=$count;$i++)
    {

     echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$str[$i][strassenname],"</td>
     <td>",$str[$i][strasse],"</td>
     <td>",$str[$i][gemkgname],"</td>";
    }

?>

</table>
</body>    