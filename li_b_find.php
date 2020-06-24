<?php
include ("connect.php");
include ("li_function.php");

$start=$_POST["start"];
if ($start == '1')
 { $page = 0;}
 else
 {
  $page=$_GET["page"];
 }




head_li_b();
echo "<div align=\"center\">Suchergebnisse</div>";
if ($start=='1')
 {
   $year=$_POST["year"];
   $number=$_POST["number"];
   $fma=$_POST["fma"];
   $flst=$_POST["flst"];
 }
 else
 {
   $year=$_GET["year"];
   $number=$_GET["number"];
   $flst=$_GET["flst"];
   $fma=$_GET["fma"];
 }


$query="SELECT * FROM li_b";

if (($year == '') AND ($number=='') AND ($fma=='') AND ($flst ==''))
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

   if($number != '')
     {
      if ($args>0)
       {$query=$query."AND number >= $number ";}
       else
       {$query=$query."number >= $number ";}
      $args=$args+1;
     }
   if($fma != "")
     {
      if ($args>0)
       {$query=$query."AND fma = $fma ";}
      else
       {$query=$query."fma = $fma ";}
     $args=$args+1;
     }
   if($flst != "")
     {
      if ($args>0)
       {$query=$query."AND flst LIKE '$flst' ";}
      else
       {$query=$query."flst LIKE '$flst' ";}
     $args=$args+1;
     }

   }


  $recanz=li_count($dbname,$query);
  $maxpage=$recanz/10;
  $maxpage=absolute($maxpage);

  echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";

li_b_page($page,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;

if ($page >0) echo "<a href=\"li_b_find.php?page=$prevpage&flst=$flst&fma=$fma&number=$number&year=$year\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_b_find.php?page=$nextpage&flst=$flst&fma=$fma&number=$number&year=$year\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>