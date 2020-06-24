<?php
include ("connect.php");
include ("li_function.php");

head_li_b();

$fma=$_POST["fma"];
$number=$_POST["number"];
$id=$_POST["id"];
$flst=$_POST["flst"];
$fa_bem=$_POST["fa_bem"];
$date=$_POST["date"];
$mit_id=$_POST["mit_id"];


$error=0;


if ($date == '')
   {
    $error=1;
    echo "<br>Sie haben kein Datum eingegeben";
    }
if ($flst == '')
   {
    $error=1;
    echo "<br>Sie m&uuml;ssen ein Flurst&uuml;ck eingeben.";
    }


 if ($error ==0)
 {
     $query="update li_b SET fma='$fma',
                             mit_id='$mit_id',
                             fa_bem='$fa_bem',
                             flst='$flst',
                             date='$date'
                             WHERE id = '$id';";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
 echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_b_liste.php?id=$id\">
</head>";
 }
 else
 {
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_b_edit.php?id=$id&error=$error\">
</head>";
 }

bottom();
?>