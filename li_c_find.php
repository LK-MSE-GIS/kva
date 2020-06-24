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




head_li_c();
echo "<div align=\"center\">Suchergebnisse</div>";
if ($start=='1')
 {
   $year=$_POST["year"];
   $number=$_POST["number"];
   $bem=$_POST["bem"];
   $grubu=$_POST["grubu"];
 }
 else
 {
   $year=$_GET["year"];
   $number=$_GET["number"];
   $bem=$_GET["bem"];
   $grubu=$_GET["grubu"];
 }


$query="SELECT * FROM li_c";

if (($year == '') AND ($number=='') AND ($bem=='') AND ($grubu ==''))
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
   if($bem != "")
     {
      if ($args>0)
       {$query=$query."AND bem LIKE '$bem' ";}
      else
       {$query=$query."bem LIKE '$bem' ";}
     $args=$args+1;
     }
   if($grubu != "")
     {
      if ($args>0)
       {$query=$query."AND grubu LIKE '$grubu' ";}
      else
       {$query=$query."grubu LIKE '$grubu' ";}
     $args=$args+1;
     }

   }


  $recanz=li_count($dbname,$query);
  $maxpage=$recanz/10;
  $maxpage=absolute($maxpage);

  echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";

li_c_page($page,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;

if ($page >0) echo "<a href=\"li_c_find.php?page=$prevpage&grubu=$grubu&bem=$bem&number=$number&year=$year\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_c_find.php?page=$nextpage&grubu=$grubu&bem=$bem&number=$number&year=$year\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>