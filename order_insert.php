<?php

include("connect.php");
include("function.php");

nav_orders();

$order_key=$_POST["order_key"];
$order_date=$_POST["order_date"];
$order_addr1=$_POST["order_addr1"];
$order_person=$_POST["order_person"];
$order_street=$_POST["order_street"];
$order_plz=$_POST["order_plz"];
$order_town=$_POST["order_town"];
$edbs=$_POST["edbs"];
$dxf=$_POST["dxf"];
$tech=$_POST["tech"];
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
$wldg=$_POST["wldg"];
$excel=$_POST["excel"];
$shape=$_POST["shape"];
$kvwmap=$_POST["kvwmap"];
$sonstiges=$_POST["sonstiges"];
$order_gem_id=$_POST["order_gem_id"];
$order_flur=$_POST["order_flur"];
$mit_id=$_POST["mit_id"];
$delivery_date=$_POST["delivery_date"];
$calc_amount=$_POST["calc_amount"];
$calc_number=$_POST["calc_number"];
$calc_prep=$_POST["calc_prep"];
$order_status=$_POST["order_status"];
$order_comment=$_POST["order_comment"];

$order_case="";
if ($fka3 == "ja") $order_case="#fka3";
if ($fkma == "ja") $order_case=$order_case."#fkma";
if ($fkpl == "ja") $order_case=$order_case."#fkpl";
if ($bsk == "ja") $order_case=$order_case."#bsk";
if ($lbwz == "ja") $order_case=$order_case."#lbwz";
if ($aeg == "ja") $order_case=$order_case."#aeg";
if ($lgbn == "ja") $order_case=$order_case."#lgbn";
if ($alba == "ja") $order_case=$order_case."#alba";
if ($albl == "ja") $order_case=$order_case."#albl";
if ($kfb == "ja") $order_case=$order_case."#kfb";
if ($kbb == "ja") $order_case=$order_case."#kbb";
if ($ksk == "ja") $order_case=$order_case."#ksk";
if ($edbs == "ja") $order_case=$order_case."#edbs";
if ($dxf == "ja") $order_case=$order_case."#dxf";
if ($tech == "ja") $order_case=$order_case."#tech";
if ($wldg == "ja") $order_case=$order_case."#wldg";
if ($excel == "ja") $order_case=$order_case."#excel";
if ($shape == "ja") $order_case=$order_case."#shape";
if ($kvwmap == "ja") $order_case=$order_case."#kvwmap";
if ($sonstiges == "ja") $order_case=$order_case."#sonstiges";

if ((strlen($order_case) < 3) OR (strlen($order_addr1) < 1) OR ($order_gem_id < 1))
  {
    echo "<h3>Es fehlen notwendige Angaben, bitte eintragen !!</h3><br>";
    if (strlen($order_case) < 1) echo "Es fehlen die Angaben was bestellt wurde?<br>";
    if (strlen($order_addr1) < 1) echo "Bitte den Auftraggeber eintragen.<br>";
    if ($order_gem_id < 1) echo "Bitte Gemarkung eintragen.<br>";
    echo "<br>";

   echo" <form action=\"order_insert.php\" method=\"post\" target=\"\">
   <input type=hidden name=\"order_key\" value=\"$order_key\">
   <h3>Neuer Auftrag:&nbsp;&nbsp; $order_key</h3>
   <table>
   <tr>
   <td valign=\"top\">
   <table border=\"0\">
   <tr>";

   echo "<td >Eingangsdatum:</td>
   <td><input type=\"date\" name=\"order_date\" value=\"$order_date\" size=\"10\"        maxlength=\"10\"></td>";

   echo "</tr>
  <tr>
  <td>Auftraggeber:</td>
  <td><input type=\"Text\" name=\"order_addr1\" value=\"$order_addr1\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>Ansprechpartner:</td>
  <td><input type=\"Text\" name=\"order_person\" value=\"$order_person\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>Stra&szlig;e:</td>
  <td><input type=\"Text\" name=\"order_street\" value=\"$order_street\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>PLZ:</td>
  <td><input type=\"Text\" name=\"order_plz\" value=\"$order_plz\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>Ort:</td>
  <td><input type=\"Text\" name=\"order_town\" value=\"$order_town\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td colspan=\"2\">&nbsp;</td>
  </tr>
  <tr>
  <td>Bearbeiter:</td>";

  echo "<td><select name=\"mit_id\">";

  $query2="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%ord%'";
  $result2=mysql_query($query2);

    while($r2=mysql_fetch_array($result2))
    {
     echo "<option";
     if($r2[mitarb_id] == $mit_id)
    {
     echo " selected";
    }
     echo " value=\"$r2[mitarb_id]\">$r2[name]</option>\n";
    }
    echo "</select>
   </td>
   </tr>
   <tr>
   <td>ausgeliefert am:</td>
   <td><input type=\"date\" name=\"delivery_date\" value=\"$delivery_date\" size=\"12\" maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Rechnungsnr.:</td>
   <td><input type=\"Text\" name=\"calc_number\" value=\"$calc_number\" size=\"12\" maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Rechnungsbetrag:</td>
   <td><input type=\"float\" name=\"calc_amount\" value=\"$calac_amount\" size=\"12\"    maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Vorkasse:
   </td>
   <td>
   <select name=\"calc_prep\">";
   if ($calc_prep ==1) { echo " <option value=\"1\" selected>nein</option>";}
                 else {echo " <option value=\"1\">nein</option>";}
   if ($calc_prep ==2) { echo " <option value=\"2\" selected>ja</option>";}
                 else {echo " <option value=\"2\">ja</option>";}
   echo "</select>
   </td>
   </tr>
   <tr>
   <td>Auftragsstatus:
   </td>
   <td>
   <select name=\"order_status\">";
   if ($order_status ==1) { echo " <option value=\"1\" selected>eingegangen</option>";}
                 else {echo " <option value=\"1\">eingegangen</option>";}
   if ($order_status ==2) { echo " <option value=\"2\" selected>abgearbeitet, noch keine Rechnung</option>";}
                 else {echo " <option value=\"2\">abgearbeitet, noch keine rechnung</option>";}
   if ($order_status ==3) { echo " <option value=\"3\" selected>abgearbeitet, wartet auf Bezahlung</option>";}
                 else {echo " <option value=\"3\">abgearbeitet, wartet auf Bezahlung</option>";}
   if ($order_status ==4) { echo " <option value=\"4\" selected>abgeschlossen</option>";}
                 else {echo " <option value=\"4\">abgeschlossen</option>";}


   echo "</select>
   </td>
   </tr>

   </table>
   </td>
   <td>&nbsp;&nbsp;</td>
   <td>
   Was wurde bestellt?
   <table>
   <tr>
   <td colspan=\"4\">&nbsp;</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"fka3\" value=\"ja\"";
    if ($fka3=="ja") echo "checked";
    echo "></td>
   <td>Flurkartenausz&uuml;ge</td>
   <td><input type=\"Checkbox\" name=\"fkpl\" value=\"ja\"";
   if ($fkpl=="ja") echo "checked";
   echo "></td>
   <td>Flurkarten-Plot</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"fkma\" value=\"ja\"";
   if ($fkma=="ja") echo "checked";
   echo "></td>
   <td>Flurkarten mit Ma&szlig;en</td>
   <td><input type=\"Checkbox\" name=\"bsk\" value=\"ja\"";
   if ($bsk=="ja") echo "checked";
   echo "></td>
   <td>Bodensch&auml;tzungskarten</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"lbwz\" value=\"ja\"";
   if ($lbwz=="ja") echo "checked";
   echo "></td>
   <td>Liste BWZ</td>
   <td><input type=\"Checkbox\" name=\"aeg\" value=\"ja\"";
   if ($aeg=="ja") echo "checked";
   echo "></td>
   <td>Alteigent&uuml;mer</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"lgbn\" value=\"ja\"";
   if ($lgbn=="ja") echo "checked";
   echo "></td>
   <td>Liste GB-Blatt-Nr.</td>
   <td><input type=\"Checkbox\" name=\"kfb\" value=\"ja\"";
   if ($kfb=="ja") echo "checked";
   echo "></td>
   <td>Kopie Flurbuch</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"kbb\" value=\"ja\"";
   if ($kbb=="ja") echo "checked";
   echo "></td>
   <td>Kopie Bestandsbl&auml;tter</td>
   <td><input type=\"Checkbox\" name=\"ksk\" value=\"ja\"";
   if ($ksk=="ja") echo "checked";
   echo "></td>
   <td>Kopie sonst. Unterl.</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"alba\" value=\"ja\"";
   if ($alba=="ja") echo "checked";
   echo "></td>
   <td>ALB-Ausz&uuml;ge</td></td>
   <td><input type=\"Checkbox\" name=\"albl\" value=\"ja\"";
   if ($albl=="ja") echo "checked";
   echo "></td>
   <td>ALB-Listen</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"wldg\" value=\"ja\"";
   if ($wldg=="ja") echo "checked";
   echo "></td>
   <td>ALB-WLDGE</td>
   <td><input type=\"Checkbox\" name=\"excel\" value=\"ja\"";
   if ($excel=="ja") echo "checked";
   echo "></td>
   <td>ALB-EXCEL</td>
   </tr>
   <tr valign=\"top\">
   <td><input type=\"Checkbox\" name=\"edbs\" value=\"ja\"";
   if ($edbs=="ja") echo "checked";
   echo "></td>
   <td>ALK-EDBS</td>
   <td><input type=\"Checkbox\" name=\"shape\" value=\"ja\"";
   if ($shape=="ja") echo "checked";
   echo "></td>
   <td>ALK-Shape</td>
   </tr>
   
   <tr>
   <td><input type=\"Checkbox\" name=\"kvwmap\" value=\"ja\"";
   if ($kvwmap=="ja") echo "checked";
   echo "></td>
   <td>kvwmap-Nutzung</td></td>
   <td><input type=\"Checkbox\" name=\"dxf\" value=\"ja\"";
   if ($dxf=="ja") echo "checked";
   echo "></td>
   <td>ALK-DXF</td>
   </tr>
   <tr>
   <td><input type=\"Checkbox\" name=\"tech\" value=\"ja\"";
   if ($tech=="ja") echo "checked";
   echo "></td>
   <td>Unterlagen für techn. Vermessung</td>
   </tr>
   <tr>
   <td colspan=\"4\"><br>Gemarkung:&nbsp;
   <select name=\"order_gem_id\">";

    $query="SELECT * FROM gemarkung ORDER BY gemarkung";
     $result=mysql_query($query);

      while($r=mysql_fetch_array($result))
         {
            echo "<option";
               if($r[gemark_id] == $order_gem_id)
                  {
                     echo " selected";
                  }
            echo " value=\"$r[gemark_id]\">$r[gemarkung]</option>\n";
         }

      echo "</select>

   </td>
  </tr>
  <tr>
  <td  colspan=\"4\">Flur:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"Text\" name=\"order_flur\" value=\"$order_flur\" size=\"25\" maxlength=\"25\"></td>
  </tr>



  </table>

  </td>
  </tr>
  </table>
  <br>Kommentar:<br>
  <textarea name=\"order_comment\" cols=\"80\" rows=\"3\">$order_comment</textarea>
  <br>
  <br>
  <input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;&nbsp;<input type=\"reset\">
  </form>";
  }
  else
  {
  $insertquery="INSERT INTO orders (order_key,order_date,order_case,order_comment,order_gem_id,order_flur,order_addr1,order_person,order_street,order_plz,order_town,mit_id,delivery_date,calc_amount,calc_number,calc_prep,order_status) VALUES ('$order_key','$order_date','$order_case','$order_comment','$order_gem_id','$order_flur','$order_addr1','$order_person','$order_street','$order_plz','$order_town','$mit_id','$delivery_date','$calc_amount','$calc_number','$calc_prep','$order_status');";

  mysql_query($insertquery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");

  ok();
echo "Die &auml;nderung im Auftrag: ",$order_key," wurde vorgenommen.<br><br>";
  }

  nav_orders();
  bottom();
?>