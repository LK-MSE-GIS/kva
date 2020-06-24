<?php
include ("connect.php");
include ("li_function.php");

head_li_c();

$fma=$_POST["fma"];
$number=$_POST["number"];
$id=$_POST["id"];
$grubu=$_POST["grubu"];
$fa_bem=$_POST["fa_bem"];
$bem=$_POST["bem"];
$date=$_POST["date"];
$mit_id=$_POST["mit_id"];


$error=0;



if ($grubu == '')
   {
    $error=1;
   }


 if ($error ==0)
 {
     $query="update li_c SET bem='$bem',
                             mit_id='$mit_id',
                             fa_bem='$fa_bem',
                             grubu='$grubu',
                             date='$date'
                             WHERE id = '$id';";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
 echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_c_liste.php?id=$id\">
</head>";
 }
 else
 {
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_c_edit.php?id=$id&error=$error\">
</head>";
 }

bottom();
?>