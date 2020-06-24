<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$id=$_GET["id"];
$zaehler=$_GET["zaehler"];
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);
$gemarkung=$r[gemkg_id];
$flur=$r[flur_id];

flur_kopf($id,$dbname);
navi_flur("fstn",$id);
abhaken($r[ID],$dbname,"80",0);

echo "<font face=\"Arial\"><div align=\"center\"><br><b>Flurstücksnenner erfassen/bearbeiten</b><br><br>";

$query="SELECT * from nenner WHERE zaehler = '$zaehler';";
$result=mysql_query($query);
$count=0;
while ($r=mysql_fetch_array($result))
   {
     $count++;
     $treffer[$count]=$r;
   }

if ($count == 0)
  {
    echo "Für den Zähler $zaehler wurde noch kein Nenner erfasst.
     <form action=\"flur_spnenner_insert.php\" method=\"post\" target=\"\">
     <input type=hidden name=\"id\" value=\"$id\">
     <input type=hidden name=\"zaehler\" value=\"$zaehler\">";
     echo "$zaehler / <input type=num name=\"nenner\" value=\"\" size=\"3\">";
     echo "<br><br>
     <input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">";
echo "</form>";
   }
   else
  { 
     $wert=$treffer[$count][nenner];
     echo "Der Nenner ist bereits erfasst.<br><br>
     <form action=\"flur_spnenner_update.php\" method=\"post\" target=\"\">
     <input type=hidden name=\"id\" value=\"$id\">
     <input type=hidden name=\"zaehler\" value=\"$zaehler\">";
     echo "$zaehler / <input type=num name=\"nenner\" value=\"$wert\" size=\"3\">";
     echo "<br><br>
     <input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">";
echo "</form>";
   echo "<br><a href=\"flur_spnenner_delete.php?id=$id&zaehler=$zaehler\">Diesen Eintrag löschen</a><br><br>";


  }

echo "<a href=\"flur_show_fstn.php?id=$id\">Zurück</a><br><br>";

nav_flur("alkgrund");
bottom();
?>