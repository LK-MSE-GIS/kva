<?php
$query="SELECT o.*, x.* FROM antrag as o, antrag_extra as x WHERE o.id=$id AND o.id=x.id";
$result=mysql_query($query,$db_link);
$r=mysql_fetch_array($result);
echo "<tr><td>";
if (($r[vermst_id]>0) AND ($r[vermart_id] !=0) AND ($r[gemark_id_1] > 0)) echo "<img src=\"images/buttons/haken.jpg\"  border=\"0\" width=\"120\">";
  else  echo "<img src=\"images/buttons/kreuz.jpg\"  border=\"0\" width=\"120\">";
  echo "<td>&nbsp;</td><td>";
if ($r[vorb_ja_nein]>0) echo "<img src=\"images/buttons/haken.jpg\"  border=\"0\" width=\"120\">";
  else echo "<img src=\"images/buttons/kreuz.jpg\"  border=\"0\" width=\"120\">";
  echo "<td>&nbsp;</td><td>";
if (($r[me_ja_nein]>0) OR ($r[vermart_id]=='10')) echo "<img src=\"images/buttons/haken.jpg\"  border=\"0\" width=\"120\">";
  else echo "<img src=\"images/buttons/kreuz.jpg\"  border=\"0\" width=\"120\">";
  echo "<td>&nbsp;</td><td>";
if (($r[alb_ja_nein]>0) AND ($r[alk_ja_nein]>0) AND ($r[ueb_ja_nein]>0)OR ($r[vermart_id]=='10')) echo "<img src=\"images/buttons/haken.jpg\"  border=\"0\" width=\"120\">";
  else echo "<img src=\"images/buttons/kreuz.jpg\"  border=\"0\" width=\"120\">";
  echo "<td>&nbsp;</td><td>";
if (($r[re_ja_nein]>0) OR ($r[vermart_id]=='10')) echo "<img src=\"images/buttons/haken.jpg\"  border=\"0\" width=\"120\">";
  else echo "<img src=\"images/buttons/kreuz.jpg\"  border=\"0\" width=\"120\">";
  echo "<td>&nbsp;</td><td>";
  echo "</tr></table>";
?>