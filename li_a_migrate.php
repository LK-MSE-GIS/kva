
<?php
include ("connect.php");

$query="SELECT * FROM li_a";
 $result=mysql_query($query);
 while($r=mysql_fetch_array($result))
  {
  $azarray=explode("/",$r[antrag]);
   $aznumber=$azarray[0];
  if ($azarray[1] > 30) $azyear="19".$azarray[1];
    else $azyear="20".$azarray[1];
   $checkquery="SELECT id FROM antrag WHERE year='$azyear' AND number='$aznumber'";
  $checkresult=mysql_query($checkquery);
  if ($checkr=mysql_fetch_array($checkresult))
     {
     $mig_query="UPDATE li_a set antrag_id='$checkr[0]' WHERE id='$r[id]'";
	 mysql_query($mig_query) OR DIE ("Es konnt nicht gel&ouml;scht werden...");
     }
  }

?>