<?php
include ("connect.php");
include ("li_function.php");

head_li_c();


$datum = getdate(time());
  $jahr=$datum[year];
  $keyquery="SELECT * FROM order_key WHERE id = '5'";
  $keyresult=mysql_query($keyquery);
  $key_r=mysql_fetch_array($keyresult);

  if ($jahr==$key_r[time])
     {
      $number=$key_r[number]+1;
      $successor=$key_r[number]+1;
      $keyquery="update order_key set number=$successor WHERE id='5'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }
      else
      {
      $number=20000;
      $keyquery="update order_key set number=$number,time='$jahr' WHERE id='5'";
      mysql_query($keyquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
      }


        $query="SELECT id from li_c where number='$number' and year ='$jahr'";
  echo $query;
  $result=mysql_query($query);
  if ($r=mysql_fetch_array($result))
     {
     $error=1;
     }
     else
     {
      $insquery="INSERT INTO li_c (number,year) VALUES ('$number','$jahr')";
     mysql_query($insquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

      $query2="SELECT id FROM li_c WHERE year='$jahr' AND number='$number';";
      $result2=mysql_query($query2);
      $r2=mysql_fetch_array($result2);

      echo "<head>
<meta http-equiv=\"refresh\" content=\"0; URL=li_c_edit.php?id=$r2[id]\">
</head>";
}

?>