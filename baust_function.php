<?php

    $datum = getdate(time());
    $year=$datum[year];
    $month=$datum[mon];
    $day=$datum[mday];
    $hour=$datum[hours];
    $min=$datum[minutes];
    $sec=$datum[seconds];

    if (strlen($month) == 1) $month='0'.$month;
    if (strlen($day) == 1) $day='0'.$day;
    if (strlen($hour) == 1) $hour='0'.$hour;
    if (strlen($min) == 1) $min='0'.$min;
    if (strlen($sec) == 1) $sec='0'.$sec;
    $print_datum=$year."-".$month."-".$day;
    $german_date=$day.".".$month.".".$year;



function head_baust()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Baustellen
  </title>
  </head>

  <body bgcolor=\"#FFFEF4\">";
}



function nav_baust()
  {
     $link_bs=URL."kva/"."baust_map.php?rechts=4545000&hoch=5932000&range=75000&name=$name&kopf=1";
     $link_wv=URL."kva/"."wv_map.php?rechts=4545000&hoch=5932000&range=75000&name=$name&kopf=1";

 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
 <td> [ <a href=\"baust_list.php?what=wer\">Baustellenliste</a>]
      [ <a href=\"$link_bs \">Baustellenkarte</a>]
      [ <a href=\"wv_list_0.php\">Werkverträge</a>]
      [ <a href=\"$link_wv \">Werkvertragskarte</a>]
      [ <a href=\"bs_list.php?status=0 \">Bodenschätzung</a>]
</tr>
</table>
<hr>";
}

function wv_navi()
  {

 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td> [ <a href=\"wv_list_0.php\">bei Verm.-Stelle</a>]
      [ <a href=\"wv_list_1.php \">bereit zur Übernahme</a>]
      [ <a href=\"wv_list_2.php\">ALB-Übernahme</a>]
      [ <a href=\"wv_list_3.php\">abgeschlossen</a>]

</tr>
</table>
<hr>";
}

function bs_navi()
  {

 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td> [ <a href=\"bs_list.php?status=0\">keine Aktion</a>]
      [ <a href=\"bs_list.php?status=1 \">bei Verm.-Stelle</a>]
      [ <a href=\"bs_list.php?status=2\">Eingangsprüfung</a>]
      [ <a href=\"bs_list.php?status=3\">in ALK ohne NS und GL</a>]
      [ <a href=\"bs_list.php?status=4\">vollständig in ALK</a>]

</tr>
</table>
<hr>";
}





function ok()
  {
  echo "<img src=\"images/ok.jpg\" alt=\"\" border=\"0\"><br><br>";
  }
function error()
  {
  echo "<img src=\"images/error.jpg\" alt=\"\" width=\"150\" border=\"0\"><br><br>";
  }

function bottom()
  {
  echo "</body> </html>";
  }



function write_log($fn,$logcontent)
{
  $filename="log/".$fn;
  $logcontent=$logcontent."\n";
  if (file_exists($filename))
   {
     $logfile=fopen($filename,"a");
   }
   else
   {
     $logfile=fopen($filename,"w");
   }
   fputs($logfile,$logcontent);
   fclose($logfile);
}


?>