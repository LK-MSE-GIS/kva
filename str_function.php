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



function head_str()
 {
  echo " <html>
  <head>
  <meta http-equiv=\"pragma\" content=\"nocache\">
  <title>
    Straßenschlüssel
  </title>
  </head>

  <body bgcolor=\"#FFFEF4\">";
}



function nav_str()
  {
 echo "<table width=\"100%\" border=\"0\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
 <td> [ <a href=\"str_start.php\">Straßenschlüssel</a>]
      [ <a href=\"ant_suchen.php\">Antragsdatenbank</a>]
      [ <a href=\"order_search.php\">Aufträge</a>]
      [ <a href=\"flur_suchen.php\">Flurdatenbank</a>]
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