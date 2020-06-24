<?php
include ("connect.php");
include ("li_function.php");

$start=$_POST["start"];
if ($start == '1')
 { $page = 0;}
 else
 {
  $page=$_GET["page"];
  $query=$_GET["query"];
  }




head_li_balk();
echo "<div align=\"center\">Suchergebnisse</div>";
if ($start == '1')
 {
$year=$_POST["year"];
$nummer=$_POST["nummer"];
$gemark_id=$_POST["gemark_id"];
$flur_id=$_POST["flur_id"];
$date=$_POST["date"];
$mitarb=$_POST["mitarb_id"];

$query="SELECT * FROM li_balk";

if (($year == '') AND ($nummer=='') AND ($gemark_id ==0) AND ($flur_id =='') AND ($date=='') AND ($mitarb ==0))
  {
  echo "Es wurde kein Suchkriterium eingegeben. Alles wird angezeigt...<br>";
  }
  else
  {
   $args=0;
   $query=$query." WHERE ";
   if ($year != '')
     {
       $query=$query."year=$year ";
       $args++;
     }

   if($nummer != "")
     {
      if ($args>0)
       {$query=$query."AND number >= $nummer ";}
       else
       {$query=$query."number >= $nummer ";}
      $args=$args+1;
     }
   if($gemark_id != '0')
     {
      if ($args>0)
       {$query=$query."AND gemark_id = $gemark_id ";}
      else
       {$query=$query."gemark_id = $gemark_id ";}
     $args=$args+1;
     }
   if($mitarb != '0')
     {
      if ($args>0)
       {$query=$query."AND mitarb_id = $mitarb ";}
      else
       {$query=$query."mitarb_id = $mitarb ";}
     $args=$args+1;
     }
   if($flur_id != '')
     {
      if ($args>0)
       {$query=$query."AND flur_id = $flur_id ";}
      else
       {$query=$query."flur_id = $flur_id ";}
     $args=$args+1;
     }
  }
 }

  $recanz=li_count($dbname,$query);
  $maxpage=$recanz/20;
  $maxpage=absolute($maxpage);

  echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";

li_balk_page($page,$dbname,$query,'1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;

if ($page >0) echo "<a href=\"li_balk_find.php?page=$prevpage&query=$query\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_balk_find.php?page=$nextpage&query=$query\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>