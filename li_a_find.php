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



head_li_a();
echo "<div align=\"center\">Suchergebnisse</div>";
if ($start == '1')
 {
  $year=$_POST["year"];
  $number=$_POST["number"];
  $antrag=$_POST["antrag"];
  $flst=$_POST["flst"];
  $vermart_id=$_POST["vermart_id"];
 }
 else
 {
  $year=$_GET["year"];
  $number=$_GET["number"];
  $antrag=$_GET["antrag"];
  $flst=$_GET["flst"];
  $vermart_id=$_GET["vermart_id"];
 }

$query="SELECT * FROM li_a";

if (($year == '') AND ($number=='') AND ($antrag=='') AND ($vermart_id ==0) AND ($flst ==''))
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
   if($antrag != "")
     {

      if ($args>0)
       {$query=$query."AND antrag LIKE '%$antrag%' ";}
      else
       {$query=$query."antrag LIKE '%$antrag%' ";}
     $args=$args+1;
     }
   if($flst != "")
     {
      if ($args>0)
       {$query=$query."AND (flst1 LIKE '$flst' OR flst2 LIKE '$flst' OR flst3 LIKE '$flst' OR flst4 LIKE '$flst') ";}
      else
       {$query=$query."(flst1 LIKE '$flst' OR flst2 LIKE '$flst' OR flst3 LIKE  '$flst' OR flst4 LIKE '$flst') ";}
     $args=$args+1;
     }
   if($vermart_id != '0')
     {
      if ($args>0)
       {$query=$query."AND vermart_id = $vermart_id ";}
      else
       {$query=$query."vermart_id = $vermart_id ";}
     $args=$args+1;
     }
   }


  $recanz=li_count($dbname,$query);
  $maxpage=$recanz/10;
  $maxpage=absolute($maxpage);

  echo "Seite: ",$page+1,"(",$maxpage+1,")&nbsp;&nbsp;Trefferanzahl: ",$recanz,"<br>";

li_a_page($page,$dbname,$query,'1','1');

echo "<br>
<table>
<tr>
<td>";
$nextpage=$page+1;
$prevpage=$page-1;

if ($page >0) echo "<a href=\"li_a_find.php?page=$prevpage&flst=$flst&year=$year&number=$number&antrag=$antrag&vermart_id=$vermart_id\"><img src=\"images/buttons/pfeil_links.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td><td>";
if ($page < $maxpage) echo "<a href=\"li_a_find.php?page=$nextpage&flst=$flst&year=$year&number=$number&antrag=$antrag&vermart_id=$vermart_id\"><img src=\"images/buttons/pfeil_rechts.png\" alt=\"\" border=\"0\" width=\"120\"></a>";
echo "</td>";
bottom();
?>