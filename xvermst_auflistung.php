<?php

include("connect.php");
include("function.php");

xhead_ant();
xmain_nav();
nav_vermst();

$dir=$_GET["dir"];
$order=$_GET["order"];



if(!$order)$order="vermst";

$query="SELECT * FROM vermst WHERE vermst_id > '0' ORDER BY $order $dir;";

$result=mysqli_query($db_link,$query);

if($dir=="")
  {
  $dir="DESC";
  }
  else
  {
  $dir="";
  }

  echo "
  <div class=\"ausgabe_bereich\">
  <!-----------Überschrift----------->
<font face=\"Arial\"><h1>Vermessungsstellen</h1></font>
</div>
<div class=\"ausgabe_bereich\">";
echo"
<table border=\"1\" >
<tr>
 <td colspan=\"4\"><h4>Auflistung aller Vermessungsstellen</h4> </td>
</tr>
<tr bgcolor=\"#80FFFF\">
 <td width=\"50\"><a href=\"xvermst_auflistung.php?order=vermst_id&dir=$dir\">ID</a></td>
 <td width=\"300\">
 <a href=\"xvermst_auflistung.php?order=vermst&dir=$dir\">Vermessungsstelle</a></td>
 <td width=\"300\"><a href=\"xvermst_auflistung.php?order=ort&dir=$dir\">Ort</a> </td>
 <td width=\"100\">&nbsp;</td>
 </tr>\n";

while($r=mysqli_fetch_array($result))
  {
  echo"
  <tr>
  <td>$r[vermst_id]</td>
 <td><a href=\"xvermst_show.php?vermst_id=$r[vermst_id]\">";
   if($r["vermst"])
    {
    echo $r["vermst"];
    }
    else
    {
    echo "???";
    }
    echo "</a>
  </td>

  <td>$r[ort]</td>
  <td><a href=\"xvermst_aendern.php?vermst_id=$r[vermst_id]\">Bearbeiten</a></td>

  </tr>\n";
  }

echo "</table></div>";
nav_vermst();
bottom();
?>