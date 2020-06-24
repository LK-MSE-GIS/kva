<?php
include ("connect_pgsql.php");
$sort=$_GET["sort"];
$dir=$_GET["dir"];

function changecolor($farbe)
 {
  if ($farbe=="#D8DCDE") $farbe="#FCFCFC";
  else $farbe="#D8DCDE";
  return $farbe;
 }   

if (strlen($sort) == 0) $sort="gemkgname";

?>
<body link=#000000 alink=#000000 vlink=#000000>
<font face="Arial">


<div align="center">

<h2>Gemarkungen/Gemeinden</h2>

<?php

 if($dir=="")
  {
  $dir="DESC";
  }
  else
  {
  $dir=" ";
  }


  $query="SELECT a.gemkgschl as gemkgschl,a.gemkgname as gemkgname,a.gemeinde as gemeinde,
b.gemeinde as gemeinde2,b.gemeindename as gemeindename from alb_v_gemarkungen as a, alb_v_gemeinden as b 
WHERE a.gemeinde=b.gemeinde ORDER BY $sort $dir";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $gemarkung[$count]=$r;
    }
   


echo "<table>
<tr>
<td width=\"250\"><a href=\"gemarkungen.php?sort=gemkgname&dir=$dir\">Gemarkungsame</a></td>
<td width=\"150\"><a href=\"gemarkungen.php?sort=gemkgschl&dir=$dir\">Nummer</a></td>
<td width=\"250\"><a href=\"gemarkungen.php?sort=gemeindename&dir=$dir\">Gemeindename</a></td>
<td width=\"150\"><a href=\"gemarkungen.php?sort=gemeinde&dir=$dir\">Nummer</a></td>
</tr>
<tr><td colspan=\"4\"><hr></td></tr>";


$color="#FCFCFC";  
for ($i=1;$i<=$count;$i++)
    {
     if ($sort=="gemkgname" OR $sort=="gemkgschl") $color=changecolor($color);
     if ($sort=="gemeindename")
      {
        if($gemarkung[$i][gemeindename] != $gemarkung[$i-1][gemeindename]) $color=changecolor($color);
      }
     if ($sort=="gemeinde")
      {
        if($gemarkung[$i][gemeinde] != $gemarkung[$i-1][gemeinde]) $color=changecolor($color);
      }

     echo "<tr bgcolor=$color style=\"font-family:Arial; font-size: 10pt; font-weight: italic\">
     <td>",$gemarkung[$i][gemkgname],"</td>
     <td>",$gemarkung[$i][gemkgschl],"</td>
     <td>",$gemarkung[$i][gemeindename],"</td>
     <td>",$gemarkung[$i][gemeinde],"</td>
    </tr>";
    }

?>

</table>
</body>    