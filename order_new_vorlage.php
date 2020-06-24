<?php
include ("connect.php");
include ("function.php");

head_order();
nav_orders();

$id=$_GET["id"];

$datum = getdate(time());
$year=$datum[year];
$month=$datum[mon];
$day=$datum[mday];

if (strlen($month) == 1) $month='0'.$month;
$localtime= substr($year,2,2).$month;

 while (strlen($day) < 2)
        {
          $day='0'.$day;
        }
$order_date=$year.'-'.$month.'-'.$day;

 $keyquery="SELECT * FROM order_key WHERE id = '1'";
 $keyresult=mysql_query($keyquery);
 $key_r=mysql_fetch_array($keyresult);
 if ($localtime == $key_r[time])
    {
      $key=$key_r[number];
      while (strlen($key) < 4)
        {
          $key='0'.$key;
        }
      $key=$localtime.'/'.$key;
    $successor=$key_r[number]+1;
    $keyquery="update order_key set number=$successor WHERE id='1'";
    mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
    }
 if ($localtime != $key_r[time])
    {
    $key=$localtime.'/0001';
    echo "Auftragsnummer: $key";
    $keyquery="update order_key set number='2', time=$localtime WHERE id='1'";
    mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
    }


$vquery="SELECT * FROm orders WHERE id='$id'";
 $vresult=mysql_query($vquery);
 $v_r=mysql_fetch_array($vresult);



  $insertquery="INSERT INTO orders (order_key,order_date,order_case,order_comment,order_gem_id,order_flur,order_addr1,order_person,order_street,order_plz,order_town,mit_id,delivery_date,calc_amount,calc_number,calc_prep,order_status) VALUES ('$key','$order_date','$v_r[order_case]','$v_r[order_comment]','$v_r[order_gem_id]','$v_r[order_flur]','$v_r[order_addr1]','$v_r[order_person]','$v_r[order_street]','$v_r[order_plz]','$v_r[order_town]','$v_r[mit_id]','$order_date','$v_r[calc_amount]',' ','$v_r[calc_prep]','2');";

  mysql_query($insertquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

$cquery="SELECT id FROM orders WHERE order_key = '$key'";
 $cresult=mysql_query($cquery);
 $c_r=mysql_fetch_array($cresult);

$new_id=$c_r[0];

echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=order_change.php?id=$new_id\">
</head>";



nav_orders();
bottom();
?>