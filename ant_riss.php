
<?php

include("connect.php");
include("function.php");

$gemark_id=$_POST["gemark_id"];
$id=$_POST["id"];
$vorschlag=$_POST["vorschlag"];
$status=$_POST["status"];
$page=$_POST["page"];
$alt=$_POST["alt"];
$defy=$_POST["defy"];

head_ant();
nav_ant();

$checkquery="SELECT a.number,a.year FROM antrag as a, risse2antrag as r WHERE a.id=r.antrag_id  AND r.gemark_id='$gemark_id' AND r.riss_id = '$vorschlag'";
$checkresult=mysql_query($checkquery,$db_link);
$check=0;
while($cr=mysql_fetch_array($checkresult))
  {
    $check++;
    echo "Die Rissnummer $vorschlag ist schon dem Aantrag $cr[number]/$cr[year] zugeordnet.<br>";
  }

if ($check > 0) 
     {
	   echo "<br><a href=\"ant_nachweise.php?id=$id&page=$page&status=$status&alt=$alt\">Zurück zum Antrag ohne eintragen</a><br><br>oder<br><br>";
       echo"<form action=\"ant_riss.php\" method=\"post\" target=\"\">
        <input type=hidden name=\"id\" value=\"$id\">
        <input type=hidden name=\"status\" value=\"$status\">
        <input type=hidden name=\"page\" value=\"$page\">
        <input type=hidden name=\"alt\" value=\"$alt\">
		<input type=hidden name=\"defy\" value=\"ja\">
        <input type=hidden name=\"vorschlag\" value=\"$vorschlag\">
		<input type=hidden name=\"gemark_id\" value=\"$gemark_id\">";

        echo " 
         <input type=submit value=\"trotzdem eintragen\"></form>";
      }	 

 if ($check == 0 OR $defy == 'ja')
    {


     echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=ant_nachweise.php?id=$id&page=$page&status=$status&alt=$alt\">
</head>";

$query="SELECT * from riss_nummer where gemark_id = '$gemark_id';";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);

if ($vorschlag == $r[last_riss]+1)
  {
    $rissnummer=$r[last_riss]+1;
    $query="update riss_nummer set last_riss=$rissnummer where gemark_id='$gemark_id';";
    mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
  }

  $query="INSERT INTO risse2antrag (antrag_id,gemark_id,riss_id) VALUES ('$id','$gemark_id','$vorschlag');";
  
  mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

  }

bottom();
?>