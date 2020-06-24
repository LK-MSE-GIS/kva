<?php
include ("connect.php");
include ("li_function.php");

head_li_a();


$antrag=$_POST["antrag"];
$id=$_POST["id"];
$number=$_POST["number"];
$year=$_POST["year"];
$flst1=$_POST["flst1"];
$flst2=$_POST["flst2"];
$flst3=$_POST["flst3"];
$flst4=$_POST["flst4"];

$vorb_date=$_POST["vorb_date"];
$vorb_mit_id=$_POST["vorb_mit_id"];
$take_date=$_POST["take_date"];
$take_mit_id=$_POST["take_mit_id"];

$error=0;

$azarray=explode("/",$antrag);
$aznumber=$azarray[0];
if ($azarray[1] > 30) $azyear="19".$azarray[1];
    else $azyear="20".$azarray[1];
$checkquery="SELECT * FROM antrag WHERE year='$azyear' AND number='$aznumber'";
echo $antrag;
echo $checkquery;
$checkresult=mysql_query($checkquery);
if ($checkr=mysql_fetch_array($checkresult))
     {
     $vermart_id =$checkr[vermart_id];
     }
     else
     {
      $error=100;
     }


if ($vorb_mit_id == '0')
   {
    $error++;
    }
if ($vorb_date == '0000-00-00')
   {
    $error++;
    }
if ($flst1 == '')
   {
    $error++;
    }

 echo $error;
 if ($error ==0)
 {
     $query="update li_a SET antrag='$antrag',
                             vermart_id='$vermart_id',
                             flst1='$flst1',
                             flst2='$flst2',
                             flst3='$flst3',
                             flst4='$flst4',
                             vorb_date='$vorb_date',
                             vorb_mit_id='$vorb_mit_id',
                             take_date='$take_date',
                             take_mit_id='$take_mit_id' WHERE id = '$id';";

      mysql_query($query) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

 echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_a_liste.php?id=$id\">
</head>";
 }
 else
 {
echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_a_edit.php?id=$id&error=$error\">
</head>";
 }

bottom();
?>