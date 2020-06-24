<?php
include ("connect.php");
include ("function.php");

head_order();
nav_orders();
echo "<font face=\"Arial\">";

$id=$_GET["id"];
$subquery=$_GET["query"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM orders WHERE id=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);

if (strlen($subquery) > 0)
echo "<a href=\"order_find.php?subquery=$subquery\"><small>Zurück zum Suchergebnis</small></a>";

  if (strpos($r[order_case],"#fka3") > -1) $fka3="ja";
  if (strpos($r[order_case],"#fkma") > -1) $fkma="ja";
  if (strpos($r[order_case],"#fkpl") > -1) $fkpl="ja";
  if (strpos($r[order_case],"#bsk") > -1) $bsk="ja";
  if (strpos($r[order_case],"#lbwz") > -1) $lbwz="ja";
  if (strpos($r[order_case],"#aeg") > -1) $aeg="ja";
  if (strpos($r[order_case],"#lgbn") > -1) $lgbn="ja";
  if (strpos($r[order_case],"#alba") > -1) $alba="ja";
  if (strpos($r[order_case],"#albl") > -1) $albl="ja";
  if (strpos($r[order_case],"#kfb") > -1) $kfb="ja";
  if (strpos($r[order_case],"#kbb") > -1) $kbb="ja";
  if (strpos($r[order_case],"#ksk") > -1) $ksk="ja";
  if (strpos($r[order_case],"#edbs") > -1) $edbs="ja";
  if (strpos($r[order_case],"#dxf") > -1) $dxf="ja";
  if (strpos($r[order_case],"#tech") > -1) $tech="ja";
  if (strpos($r[order_case],"#wldg") > -1) $wldg="ja";
  if (strpos($r[order_case],"#excel") > -1) $excel="ja";
  if (strpos($r[order_case],"#shape") > -1) $shape="ja";
  if (strpos($r[order_case],"#kvwmap") > -1) $kvwmap="ja";
  if (strpos($r[order_case],"#sonstiges") > -1) $sonstiges="ja";

   echo" <form action=\"order_change_insert.php\" method=\"post\" target=\"\">
   <input type=hidden name=\"id\" value=\"$id\">
   <input type=hidden name=\"order_key\" value=\"$r[order_key]\">
   <h3> Auftrag bearbeiten:&nbsp;&nbsp; $r[order_key]</h3>
   <table>
   <tr>
   <td valign=\"top\">
   <table border=\"0\">
   <tr>";

   echo "<td >Eingangsdatum:</td>
   <td><input type=\"date\" name=\"order_date\" value=\"$r[order_date]\" size=\"10\"        maxlength=\"10\"></td>";

   echo "</tr>
  <tr>
  <td>Auftraggeber:</td>
  <td><input type=\"Text\" name=\"order_addr1\" value=\"$r[order_addr1]\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>Ansprechpartner:</td>
  <td><input type=\"Text\" name=\"order_person\" value=\"$r[order_person]\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>Stra&szlig;e:</td>
  <td><input type=\"Text\" name=\"order_street\" value=\"$r[order_street]\" size=\"40\" maxlength=\"40\"></td>
  </tr>
  <tr>
  <td>PLZ:</td>
  <td><input type=\"Text\" name=\"order_plz\" value=\"$r[order_plz]\" size=\"7\" maxlength=\"7\"></td>
  </tr>
  <tr>
  <td>Ort:</td>
  <td><input type=\"Text\" name=\"order_town\" value=\"$r[order_town]\" size=\"40\" maxlength=\"40\"></td>
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
     if($r2[mitarb_id] == $r[mit_id])
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
   <td><input type=\"date\" name=\"delivery_date\" value=\"$r[delivery_date]\" size=\"12\" maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Rechnungsnr.:</td>
   <td><input type=\"Text\" name=\"calc_number\" value=\"$r[calc_number]\" size=\"12\" maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Rechnungsbetrag:</td>
   <td><input type=\"float\" name=\"calc_amount\" value=\"$r[calc_amount]\" size=\"12\"    maxlength=\"12\"></td>
   </tr>
   <tr>
   <td>Vorkasse:
   </td>
   <td>
   <select name=\"calc_prep\">";
   if ($r[calc_prep] ==1) { echo " <option value=\"1\" selected>nein</option>";}
                 else {echo " <option value=\"1\">nein</option>";}
   if ($r[calc_prep] ==2) { echo " <option value=\"2\" selected>ja</option>";}
                 else {echo " <option value=\"2\">ja</option>";}
   echo "</select>
   </td>
   </tr>
   <tr>
   <td>Auftragsstatus:
   </td>
   <td>
   <select name=\"order_status\">";
   if ($r[order_status]==1)
      {echo "<option value=\"1\" selected>eingegangen</option>";}
      else {echo"<option value=\"1\">eingegangen</option>";}
   if ($r[order_status]==9)
      {echo "<option value=\"9\" selected>Angebot erstellt</option>";}
      else {echo"<option value=\"9\">Angebot erstellt</option>";}
   if ($r[order_status]==2)
      {echo "<option value=\"2\" selected>abgearbeitet, noch keine Rechnung</option>";}
      else {echo"<option value=\"2\">abgearbeitet, noch keine Rechnung</option>";}
   if ($r[order_status]==3)
      {echo "<option value=\"3\" selected>abgearbeitet, wartet auf Bezahlung</option>";}
      else {echo"<option value=\"3\">abgearbeitet, wartet auf Bezahlung</option>";}
   if ($r[order_status]==4)
      {echo "<option value=\"4\" selected>abgeschlossen</option>";}
      else {echo"<option value=\"4\">abgeschlossen</option>";}
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
   <td><input type=\"Checkbox\" name=\"sonstiges\" value=\"ja\"";
   if ($sonstiges=="ja") echo "checked";
   echo "></td>
   <td>sonstiges</td>
   </tr>
   
   <tr>
   <td colspan=\"4\"><br>Gemarkung:&nbsp;
   <select name=\"order_gem_id\">";

    $gemquery="SELECT * FROM gemarkung ORDER BY gemarkung";
     $gemresult=mysql_query($gemquery);

      while($gemr=mysql_fetch_array($gemresult))
         {
            echo "<option";
               if($gemr[gemark_id] == $r[order_gem_id])
                  {
                     echo " selected";
                  }
            echo " value=\"$gemr[gemark_id]\">$gemr[gemarkung]</option>\n";
         }

      echo "</select>

   </td>
  </tr>
  <tr>
  <td  colspan=\"4\">Flur:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"Text\" name=\"order_flur\" value=\"$r[order_flur]\" size=\"25\" maxlength=\"25\"></td>
  </tr>



  </table>

  </td>
  </tr>
  </table>
  <br>Kommentar:<br>
  <textarea name=\"order_comment\" cols=\"80\" rows=\"3\">$r[order_comment]</textarea>
  <br>
  <br>
  <input type=\"Submit\" name=\"\" value=\"Eintragen\">&nbsp;&nbsp;<input type=\"reset\">
  &nbsp;&nbsp;&nbsp;<a href=\"order_delete.php?id=$id&order_key=$r[order_key]&order_addr1=$r[order_addr1]\">Auftrag $r[order_key] l&ouml;schen</a>&nbsp;&nbsp;&nbsp;<a href=\"order_new_vorlage.php?id=$r[id]\">als Vorlage benutzen</a>
  </form>";




nav_orders();
bottom();
?>