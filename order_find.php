<?php

include("connect.php");
include("function.php");

head_order();
nav_orders();

$subquery=$_GET["subquery"];
if (strlen($subquery) == 0)
{

$order_key=$_POST["order_key"];
$order_date_from=$_POST["order_date_from"];
$order_date_to=$_POST["order_date_to"];
$order_addr1=$_POST["order_addr1"];
$order_gem_id=$_POST["order_gem_id"];
$delivery_date_from=$_POST["delivery_date_from"];
$delivery_date_to=$_POST["delivery_date_to"];
$mit_id=$_POST["mit_id"];
$calc_number=$_POST["calc_number"];
$calc_prep=$_POST["calc_prep"];
$order_status=$_POST["order_status"];

$edbs=$_POST["edbs"];
$dxf=$_POST["dxf"];
$albl=$_POST["albl"];
$fka3=$_POST["fka3"];
$fkma=$_POST["fkma"];
$fkpl=$_POST["fkpl"];
$bsk=$_POST["bsk"];
$lbwz=$_POST["lbwz"];
$aeg=$_POST["aeg"];
$lgbn=$_POST["lgbn"];
$alba=$_POST["alba"];
$kfb=$_POST["kfb"];
$kbb=$_POST["kbb"];
$ksk=$_POST["ksk"];
$tech=$_POST["tech"];
$wldg=$_POST["wldg"];
$excel=$_POST["excel"];
$shape=$_POST["shape"];
$kvwmap=$_POST["kvwmap"];
$sonstiges=$_POST["sonstiges"];



$query="SELECT * FROM orders WHERE ";


$args=0;
if($order_key != "")
  {
  $query=$query . "order_key LIKE '$order_key%' ";
  $args=$args+1;
  }
if($order_date_from != "")
  {
  if ($args>0)
    {
     $query=$query."AND order_date >= '$order_date_from' ";
    }
    else
    {
    $query=$query."order_date >= '$order_date_from' ";
    }
   $args=$args+1;
   }
if($order_date_to != "")
  {
  if ($args>0)
    {
     $query=$query."AND order_date <= '$order_date_to' ";
    }
    else
    {
    $query=$query."order_date <= '$order_date_to' ";
    }
   $args=$args+1;
   }
if($delivery_date_from != "")
  {
  if ($args>0)
    {
     $query=$query."AND delivery_date >= '$delivery_date_from' ";
    }
    else
    {
    $query=$query."delivery_date >= '$delivery_date_from' ";
    }
   $args=$args+1;
   }
  if($delivery_date_to != "")
  {
  if ($args>0)
    {
     $query=$query."AND delivery_date <= '$delivery_date_to' ";
    }
    else
    {
    $query=$query."delivery_date <= '$delivery_date_to' ";
    }
   $args=$args+1;
   }
  if($order_addr1 != "")
  {
  if ($args>0)
    {
     $query=$query."AND order_addr1 LIKE '%$order_addr1%' ";
    }
    else
    {
    $query=$query."order_addr1 LIKE '%$order_addr1%' ";
    }
   $args=$aargs+1;
  }

if($order_gem_id>0)
  {
  if ($args>0)
    {
     $query=$query."AND order_gem_id = '$order_gem_id' ";
    }
    else
    {
    $query=$query."order_gem_id = '$order_gem_id' ";
    }
   $args=$aargs+1;
  }
if($calc_number != "")
  {
  if ($args>0)
    {
     $query=$query."AND calc_number LIKE '$calc_number%' ";
    }
    else
    {
    $query=$query."calc_number LIKE '$calc_number%' ";
    }
   $args=$aargs+1;
  }
if($mit_id > 0)
  {
  if ($args>0)
    {
     $query=$query."AND mit_id = '$mit_id' ";
    }
    else
    {
    $query=$query."mit_id = '$mit_id' ";
    }
   $args=$aargs+1;
  }
if($calc_prep >0)
  {
  if ($args>0)
    {
     $query=$query."AND calc_prep = '$calc_prep' ";
    }
    else
    {
    $query=$query."calc_prep = '$calc_prep' ";
    }
   $args=$aargs+1;
  }
if($order_status >0)
  {
  if ($args>0)
    {
     $query=$query."AND order_status = '$order_status' ";
    }
    else
    {
    $query=$query."order_status = '$order_status' ";
    }
   $args=$aargs+1;
  }
if ($args>0){ $case_query=" AND (";}
  else { $case_query=" (";}
$case_args=0;
if ($fka3 == "ja")
   {
   $case_query=$case_query."order_case LIKE '%#fka3%' ";
   $case_args=$case_args+1;
   }
if ($fkma == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#fkma%' ";}
      else {$case_query=$case_query."order_case LIKE '%#fkma%' ";}
   $case_args=$case_args+1;
   }
if ($fkpl == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#fkpl%' ";}
      else {$case_query=$case_query."order_case LIKE '%#fkpl%' ";}
   $case_args=$case_args+1;
   }
if ($bsk == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#bsk%' ";}
      else {$case_query=$case_query."order_case LIKE '%#bsk%' ";}
   $case_args=$case_args+1;
   }
if ($lbwz == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#lbwz%' ";}
      else {$case_query=$case_query."order_case LIKE '%#lbwz%' ";}
   $case_args=$case_args+1;
   }
if ($aeg == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#aeg%' ";}
      else {$case_query=$case_query."order_case LIKE '%#aeg%' ";}
   $case_args=$case_args+1;
   }
if ($lgbn == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#lgbn%' ";}
      else {$case_query=$case_query."order_case LIKE '%#lgbn%' ";}
   $case_args=$case_args+1;
   }
if ($alba == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#alba%' ";}
      else {$case_query=$case_query."order_case LIKE '%#alba%' ";}
   $case_args=$case_args+1;
   }
if ($albl == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#albl%' ";}
      else {$case_query=$case_query."order_case LIKE '%#albl%' ";}
   $case_args=$case_args+1;
   }
if ($kfb == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#kfb%' ";}
      else {$case_query=$case_query."order_case LIKE '%#kfb%' ";}
   $case_args=$case_args+1;
   }
if ($kbb == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#kbb%' ";}
      else {$case_query=$case_query."order_case LIKE '%#kbb%' ";}
   $case_args=$case_args+1;
   }
if ($ksk == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#ksk%' ";}
      else {$case_query=$case_query."order_case LIKE '%#ksk%' ";}
   $case_args=$case_args+1;
   }
if ($edbs == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#edbs%' ";}
      else {$case_query=$case_query."order_case LIKE '%#edbs%' ";}
   $case_args=$case_args+1;
   }
if ($dxf == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#dxf%' ";}
      else {$case_query=$case_query."order_case LIKE '%#dxf%' ";}
   $case_args=$case_args+1;
   }
if ($tech == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#tech%' ";}
      else {$case_query=$case_query."order_case LIKE '%#tech%' ";}
   $case_args=$case_args+1;
   }
if ($wldg == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#wldg%' ";}
      else {$case_query=$case_query."order_case LIKE '%#wldg%' ";}
   $case_args=$case_args+1;
   }
if ($excel == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#excel%' ";}
      else {$case_query=$case_query."order_case LIKE '%#excel%' ";}
   $case_args=$case_args+1;
   }
if ($shape == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#shape%' ";}
      else {$case_query=$case_query."order_case LIKE '%#shape%' ";}
   $case_args=$case_args+1;
   }
if ($kvwmap == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#kvwmap%' ";}
      else {$case_query=$case_query."order_case LIKE '%#kvwmap%' ";}
   $case_args=$case_args+1;
   }
if ($sonstiges == "ja")
   {
   if ($case_args > 0) {$case_query=$case_query."OR order_case LIKE '%#sonstiges%' ";}
      else {$case_query=$case_query."order_case LIKE '%#sonstiges%' ";}
   $case_args=$case_args+1;
   }
if ($case_args>0) $case_query=$case_query.')';



  if ($case_args > 0)
  {
   $query=$query.$case_query;
   $args=$args+1;
  }

$query=$query." ORDER by order_key;";
}
else 
  {
   $args=1;
   $query=$subquery;
   }

if($args>0)
{
$result=mysql_query($query);
$treffer=0;
echo"
<table border=\"0\" >
<tr>
 <td colspan=\"7\" align=\"center\"><marquee>Suchergebnisse</marquee> </td>
</tr>
<tr bgcolor=\"#80FF00\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
 <td  width=\"35\">Nummer</td>
 <td width=\"200\">Auftraggeber</td>
 <td width=\"75\"><small>Eing.-datum</td>
 <td width=\"100\"><small>Bearbeiter</td>
 <td width=\"60\"><small>Gemarkung</td>
 <td width=\"30\"><small>Bestellung</td>
 <td width=\"10\"></td>
 <td><small>Rechnungs-<br>nummer</small></td>
 <td><small>Status</small></td>
 <td width=\"10\">&nbsp;</td>
 </tr>

<small>";
$i=1;
$betrag=0;
while($r=mysql_fetch_array($result))
  {
    $quot=$i%2;
    if($quot ==1)
    {
    $Farbe="#D8DCDE";
    }
    else
    {
    $Farbe="#FCFCFC";
    }
  $treffer=$treffer+1;
  if ($r[order_status]==4) $betrag=$betrag+$r[calc_amount];
  echo"
  <tr bgcolor=\"$Farbe\" style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
  <td  align=\"center\">$r[order_key]</td>
  <td>$r[order_addr1]</td>
  <td><small>$r[order_date]</td>
  <td>";
     $query5="SELECT * FROM mitarbeiter WHERE mitarb_id=$r[mit_id]";
     $result5=mysql_query($query5);
     $r5=mysql_fetch_array($result5);
     echo"<small>$r5[name]
  </td>
  <td>";
     $query4="SELECT * FROM gemarkung WHERE gemark_id=$r[order_gem_id]";
     $result4=mysql_query($query4);
     $r4=mysql_fetch_array($result4);
     echo"<small>$r4[gemarkung]
  </td>
  <td><small>";
  if (strpos($r[order_case],"#fka3") > -1) echo "&nbsp;Flurkartenausz&uuml;ge&nbsp;<br>";
  if (strpos($r[order_case],"#fkma") > -1) echo "&nbsp;Flurkarte mit Maﬂen&nbsp;<br>";
  if (strpos($r[order_case],"#fkpl") > -1) echo "&nbsp;Flurkarte-Plot&nbsp;<br>";
  if (strpos($r[order_case],"#bsk") > -1) echo "&nbsp;Bodensch&auml;tzung&nbsp;<br>";
  if (strpos($r[order_case],"#lbwz") > -1) echo "&nbsp;Liste BWZ&nbsp;<br>";
  if (strpos($r[order_case],"#aeg") > -1) echo "&nbsp;Alteigent&uuml;mer&nbsp;<br>";
  if (strpos($r[order_case],"#lgbn") > -1) echo "&nbsp;Liste GB-Blatt-Nr.&nbsp;<br>";
  if (strpos($r[order_case],"#alba") > -1) echo "&nbsp;ALB-Ausz&uuml;ge&nbsp;<br>";
  if (strpos($r[order_case],"#albl") > -1) echo "&nbsp;ALB-Druckliste&nbsp;<br>";
  if (strpos($r[order_case],"#kfb") > -1) echo "&nbsp;Kopie Flurbuch&nbsp;<br>";
  if (strpos($r[order_case],"#kbb") > -1) echo "&nbsp;Kopie-Bestndsbl&auml;tter&nbsp;<br>";
  if (strpos($r[order_case],"#ksk") > -1) echo "&nbsp;Kopie sonstige Unterlagen&nbsp;<br>";
  if (strpos($r[order_case],"#edbs") > -1) echo "&nbsp;ALK-EDBS&nbsp;<br>";
  if (strpos($r[order_case],"#dxf") > -1) echo "&nbsp;ALK-DXF&nbsp;<br>";
  if (strpos($r[order_case],"#tech") > -1) echo "&nbsp;technische Verm.&nbsp;<br>";
  if (strpos($r[order_case],"#wldg") > -1) echo "&nbsp;ALB-WLDGE&nbsp;<br>";
  if (strpos($r[order_case],"#excel") > -1) echo "&nbsp;ALB-EXCEL&nbsp;<br>";
  if (strpos($r[order_case],"#shape") > -1) echo "&nbsp;ALK-Shape&nbsp;<br>";
  if (strpos($r[order_case],"#kvwmap") > -1) echo "&nbsp;kvwmap&nbsp;<br>";
  if (strpos($r[order_case],"#sonstiges") > -1) echo "&nbsp;sonst.&nbsp;<br>";
  echo "</small></td>
  <td>";
  if ($r[calc_prep]=="2") echo "&nbsp;V&nbsp;";
  echo "</td>
  <td><small>$r[calc_number]";
  if ($r[calc_amount] > 0) echo "<br>",number_format($r[calc_amount],2,",",".");
  echo "</small></td>
  <td><small>";
  if ($r[order_status]==1)
  {
   echo "eingegangen";
   $colour="#FF0000";
  }
  if ($r[order_status]==9)
  {
   echo "Angebot erstellt";
   $colour="#FFFF80";
  }
  if ($r[order_status]==2)
  {
   echo "abgearbeitet<br>noch keine Rechnung";
   $colour="#FFFF80";
  }
  if ($r[order_status]==3)
  {
   echo "abgearbeitet<br>wartet auf Bezahlung";
   $colour="##0080C0";
  }
  if ($r[order_status]==4)
  {
   echo "abgeschlossen";
   $colour="#00FF00";
  }
  echo "</small>
  </td>
  </td>
  <td bgcolor=\"$colour\" ><a href=\"order_change.php?id=$r[id]&query=$query\"><small><img src=\"images/buttons/b_edit.png\" alt=\"Bearbeiten\" border=\"0\"></a></td>

  </tr>";
$i=$i+1;
  }
echo "<tr><td></td></tr><tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"><td colspan=\"7\" align=\"right\">Gesamtsumme der abgeschlossenen Auftr‰ge:&nbsp;</td><td>",number_format($betrag,2,",","."),"</td></tr>";
echo "</small></table>";
echo "<br>Anzahl der Treffer: ",$treffer,"<br>";
if ($i == 1)
  {
  echo "<table>
  <tr>
 <td><h2>Leider nichts gefunden...</h2> </td>
 <td> <img src=\"images/error.jpg\" alt=\"\" border=\"0\" width=\"150\"></td>
</tr>
  </table>";
  }
}
else
{
echo "<h3>Sie haben die Suche nicht eingegrenzt !<br>Bitte geben Sie mindestens ein Suchkriterium ein.<br></h3><img src=\"images/error.jpg\" alt=\"\" border=\"0\" width=\"150\">";
}





nav_orders();
bottom();
?>