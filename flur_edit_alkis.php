<?php
include ("connect.php");
include ("function.php");

head_flur();
nav_flur("alkis");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;

$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);

if ($r[alkis_feldnutz_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_feldnutz_anr]'";
     $anrresult=mysql_query($anrquery);
     $anrr=mysql_fetch_array($anrresult);
     $alkis_feldok_dat=$anrr[alk_datum];
     $alkis_feldorder_dat=$anrr[eing_datum];
     $az=$anrr[number]."/".$anrr[year];
     if ($alkis_feldok_dat != '0000-00-00')
        $updatequery="UPDATE flur set alkis_feldok_dat ='$alkis_feldok_dat', alkis_feldorder_dat='$alkis_feldorder_dat', alkis_feldnutz_stat='2' where ID='$id'";
        else
        $updatequery="UPDATE flur set alkis_feldok_dat ='$alkis_feldok_dat', alkis_feldorder_dat='$alkis_feldorder_dat' where ID='$id'";
     mysql_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

if ($r[alkis_flber_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_flber_anr]'";
     $anrresult=mysql_query($anrquery);
     $anrr=mysql_fetch_array($anrresult);
     $alkis_flber_dat=$anrr[alk_datum];
     $alkis_florder_dat=$anrr[eing_datum];
     $flberaz=$anrr[number]."/".$anrr[year];
     $updatequery="UPDATE flur set alkis_flber_dat ='$alkis_flber_dat', alkis_florder_dat='$alkis_florder_dat' where ID='$id'";
     mysql_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

if ($r[alkis_fldig_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where id ='$r[alkis_fldig_anr]'";
     $anrresult=mysql_query($anrquery);
     $anrr=mysql_fetch_array($anrresult);
     $alkis_fldig_dat=$anrr[alk_datum];
     $alkis_fldigord_dat=$anrr[eing_datum];
     $fldigaz=$anrr[number]."/".$anrr[year];
     $updatequery="UPDATE flur set alkis_fldig_dat ='$alkis_fldig_dat', alkis_fldigord_dat='$alkis_fldigord_dat' where ID='$id'";
     mysql_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

if ($r[alkis_mig_anr] > '0')
   {
     $anrquery="SELECT number,year,alk_datum,eing_datum from antrag where ID ='$r[alkis_mig_anr]'";
     $anrresult=mysql_query($anrquery);
     $anrr=mysql_fetch_array($anrresult);
     $migaz=$anrr[number]."/".$anrr[year];
   }

$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);


$stat=0;

#if ($r[alkis_fl_stat] == '1') $stat=$stat+2;
if (($r[alkis_flber_anr] > 0 AND $r[alkis_flber_dat] != '0000-00-00') AND $r[alkis_fldig_anr] == '-1') $stat=$stat+2;
if (($r[alkis_fldig_anr] > 0 AND $r[alkis_fldig_dat] != '0000-00-00') AND $r[alkis_flber_anr] == '-1') $stat=$stat+2;
if (($r[alkis_flber_anr] > 0 AND $r[alkis_flber_dat] != '0000-00-00') AND ($r[alkis_fldig_anr] > 0 AND $r[alkis_fldig_dat] != '0000-00-00')) $stat=$stat+2;

if ($stat >= '2')
    {
     $updatequery="UPDATE flur set alkis_fl_stat ='4' where ID='$id'";
     mysql_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }     

if ($r[alkis_flber_anr] == '-1' AND $r[alkis_fldig_anr] == '-1')
    {
     $updatequery="UPDATE flur set alkis_fl_stat ='5' where ID='$id'";
     mysql_query($updatequery) OR DIE ("Der Eintrag konnte nicht angelegt werden...");
   }

$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);

$gemarkung_1=$r[gemkg_id];
$flur_1=$r[flur_id];
while (strlen($flur_1) <3)
  {
    $flur_1='0'.$flur_1;
  }
$flur_id_1=$gemarkung_1."-".$flur_1;


flur_kopf($id,$dbname);
navi_flur("alkis",$id);
abhaken($r[ID],$dbname,"80",0);

 echo"</table>
<form action=\"flur_ins_alkis.php\" method=\"post\" target=\"\">
<input type=hidden name=\"id\" value=\"$id\">
<input type=hidden name=\"nutz_alt\" value=\"$r[alkis_feldnutz_stat]\">
<input type=hidden name=\"fl_alt\" value=\"$r[alkis_fl_stat]\">
<input type=hidden name=\"dat_alt\" value=\"$r[alkis_akt1_dat]\">
<input type=hidden name=\"mitid_alt\" value=\"$r[alkis_akt1_mitid]\">";
echo "<br><table>
<tr valign=\"top\"><td>
<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">ALKIS-Vormigration<br>Feldvergleich (Geb&auml;ude)</td>
</tr>";
if ($r[geb]=='0')
 {
 echo "<tr><td align=\"center\"><img src=\"images/no_house.jpg\"  border=\"0\" width=\"90\"></td></tr><tr><td>";
 if (((strpos($abteilung,"vbk") > -1) OR (strpos($abteilung,"adm") > -1)) AND ($flur_id_1 != '')) echo "&nbsp;<a href=\"flur_baust_ins.php?flur_id=$flur_id_1&mitarb=$username&id=$id\"><img src=\"images/traffic.jpg\" alt=\"\" border=\"0\" width=\"25\"></a>";
 echo "</td></tr>";
 }
 else
 {
echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_feld_dat\" value=\"$r[alkis_feld_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_feld_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%feld%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_feld_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Status</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_feld_stat\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_feld_stat]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">keine Aktion</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_feld_stat]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">abgeschlossen</option>
    </select></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">in DB eingearbeitet am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_felddb_dat\" value=\"$r[alkis_felddb_dat]\" size=\"10\" >";
if (((strpos($abteilung,"vbk") > -1) OR (strpos($abteilung,"adm") > -1)) AND ($flur_id_1 != '') AND ($r[alkis_felddb_dat] =='0000-00-00')) 
  echo "&nbsp;<a href=\"flur_baust_ins.php?flur_id=$flur_id_1&mitarb=$username&id=$id\"><img src=\"images/traffic.jpg\" alt=\"\" border=\"0\" width=\"25\"></a>";
echo "</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_felddb_mitid\">";

 $query10="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result10=mysql_query($query10);

 while($r10=mysql_fetch_array($result10))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r10[mitarb_id] == $r[alkis_felddb_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r10[mitarb_id]\">$r10[name]</option>\n";
   }
   echo "
      </select>
 </td>
 </tr>";
}
echo "</table><br>";
################################Feldvergleich Nutzungsarten

echo "<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">Feldvergleich (Nutzungsarten)</td>
</tr>";
if ($r[alkis_feldnutz_stat] != '1')
   {
    if (($r[alkis_feldnutz_anr] == 0) AND ($r[alkis_feldnutz_stat] == '0'))
      if (strpos($abteilung,"akt1") > '-1')
         echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\"><a href=\"flur_create_anr.php?gemkg_id=$r[gemkg_id]&flur_id=$r[flur_id]&case=nu&id=$id\">Auftrag erstellen</a></td>
            </tr>";

      
     if ($r[alkis_feldnutz_anr] > 0)
       {
        echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\">Antrag: $az&nbsp;
         <a href=\"flur_ant_suchen.php?id=$r[alkis_feldnutz_anr]\"><img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a>";
        if ($alkis_feldok_dat != '0000-00-00') echo " ist übernommen";
        echo "</td></tr>";
       }
 if ($r[alkis_feldnutz_anr] > 0)
  {
   echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">beauftragt am:</td> 
<td>$r[alkis_feldorder_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_feldorder_dat\" value=\"$r[alkis_feldorder_dat]\" size=\"10\" ></td>
</tr>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">in DB übernommen am:</td> 
<td>$r[alkis_feldok_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_feldok_dat\" value=\"$r[alkis_feldok_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Aussendienst-Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_feldnutz_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%feld%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_feldnutz_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>";
   }
 }
if ($r[alkis_feldnutz_stat] == '2')
     {
      echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">Bearbeitung abgeschlossen</td></tr>";
     }
     else
      if ($r[alkis_feldnutz_anr] > 0) echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">Bearbeitung läuft</td></tr>";
      else
     if (strpos($abteilung,"akt1") > '-1')
       {
         echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
         <td bgcolor=\"#ECD513\">Status</td>
        <td>";
        echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_feldnutz_stat\">
        <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
        if($r[alkis_feldnutz_stat]==0)
         {
           echo " selected";
          }
        echo " value=\"0\">keine Aktion</option>
        <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
        if($r[alkis_feldnutz_stat]==1)
         {
          echo " selected";
          }
        echo " value=\"1\">nicht erforderlich</option>
        </select>";
      
        echo "</td>
       </tr>";
       }
       else
        {
        echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
         <td bgcolor=\"#ECD513\">Status: </td><td>";
        if ($r[alkis_feldnutz_stat] == '1') echo "nicht erforderlich";
        if ($r[alkis_feldnutz_stat] == '0') echo "keine Aktion";
        if ($r[alkis_feldnutz_stat] == '2') echo "Bearbeitung abgeschlossen";
        echo "<input type=hidden name=\"alkis_feldnutz_stat\" value=\"$r[alkis_feldnutz_stat]\">";
        echo "</td></tr>";
         }
       
   
echo "</table><br>";

##############################Flächendifferenzen

echo "<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">Flächendifferenzen</td>
</tr>";
if ($r[alkis_fl_stat] >= '2')
   {
    if (($r[alkis_flber_anr] == 0) AND ($r[alkis_fl_stat] == '3'))
        if ((strpos($abteilung,"akt1") > -1 OR strpos($abteilung,"adm") > -1 OR strpos($abteilung,"akt1") > -1)) 
           echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\"><a href=\"flur_create_anr.php?gemkg_id=$r[gemkg_id]&flur_id=$r[flur_id]&case=flber&id=$id\">Berechnungs-Auftrag erstellen</a>
            &nbsp;&nbsp;<a href=\"flur_drop_anr.php?id=$id&feld=alkis_flber_anr\"><img src=\"images/buttons/b_drop.png\" border=\"0\"></a>
           </td></tr>";
         else
           echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\">noch kein Auftrag angelegt</td></tr>";
     
     if ($r[alkis_flber_anr] > 0)
       {
        echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\">Berechnungs-Antrag: $flberaz&nbsp;
         <a href=\"flur_ant_suchen.php?id=$r[alkis_flber_anr]\">
        <img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a>";
           if ($alkis_flber_dat != '0000-00-00') echo " ist übernommen";
           echo "</td></tr>";
        

          echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
         <td bgcolor=\"#ECD513\">beauftragt am:</td> 
         <td>$r[alkis_florder_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_florder_dat\" value=\"$r[alkis_florder_dat]\" size=\"10\" ></td>
         </tr>
         </tr>
         <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
         <td bgcolor=\"#ECD513\">in DB übernommen am:</td> 
         <td>$r[alkis_flber_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_flber_dat\" value=\"$r[alkis_flber_dat]\" size=\"10\" ></td>
         </tr>
         <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
         <td bgcolor=\"#ECD513\">Mitarbeiter:</td>
         <td>
         <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_flber_mitid\">";

         $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
         $result5=mysql_query($query5);

          while($r5=mysql_fetch_array($result5))
          {
           echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
            if($r5[mitarb_id] == $r[alkis_flber_mitid])
             {
              echo " selected";
              }
             echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
      }
   echo "</select> </td></tr>";
 }


    if (($r[alkis_fldig_anr] == 0) AND ($r[alkis_fl_stat] == '3'))
        if ((strpos($abteilung,"akt1") > -1 OR strpos($abteilung,"adm") > -1 OR strpos($abteilung,"akt1") > -1)) 
          echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\"><a href=\"flur_create_anr.php?gemkg_id=$r[gemkg_id]&flur_id=$r[flur_id]&case=fldig&id=$id\">Digitalisierungs-Auftrag erstellen</a>
            &nbsp;&nbsp;<a href=\"flur_drop_anr.php?id=$id&feld=alkis_fldig_anr\"><img src=\"images/buttons/b_drop.png\" border=\"0\"></a></td></tr>";
         else
           echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\">noch kein Auftrag angelegt</td></tr>";
         

     if ($r[alkis_fldig_anr] > 0)
       {
        echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
           <td bgcolor=\"#ECD513\" colspan=\"2\">Digitalisierungs-Antrag: $fldigaz&nbsp;
         <a href=\"flur_ant_suchen.php?id=$r[alkis_fldig_anr]\">
         <img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a>";
           if ($alkis_fldig_dat != '0000-00-00') echo " ist übernommen";
           echo "</td></tr>";
        



 echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">beauftragt am:</td> 
<td>$r[alkis_fldigord_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_fldigord_dat\" value=\"$r[alkis_fldig_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">in DB übernommen am:</td> 
<td>$r[alkis_fldig_dat]<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"hidden\" name=\"alkis_fldig_dat\" value=\"$r[alkis_fldig_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_fldig_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_fldig_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>";
  }
}
echo "<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Status</td>
<td>";
if ($r[alkis_fl_stat] < '3')
  {
  if ((strpos($abteilung,"akt1") > -1 OR strpos($abteilung,"adm") > -1)) 
  {
   echo "<select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_fl_stat\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_fl_stat]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">keine Aktion</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_fl_stat]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">nicht erforderlich</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_fl_stat]==3)
    {
    echo " selected";
    }
    echo " value=\"3\">Klärung beauftragen</option>
    </select>";
   }
   else
   {
    if ($r[alkis_fl_stat] == '1') echo "nicht erforderlich";
    if ($r[alkis_fl_stat] == '0') echo "keine Aktion";
    if ($r[alkis_fl_stat] == '3') echo "Klärung beauftragen";
    echo "<input type=hidden name=\"alkis_fl_stat\" value=\"$r[alkis_fl_stat]\">";
    }
   }
   else 
    {
      if ($r[alkis_fl_stat] == '3') echo "Bearbeitung läuft";
      if ($r[alkis_fl_stat] == '4') echo "Bearbeitung abgeschlossen";
      if ($r[alkis_fl_stat] == '5') echo "nicht möglich";
      echo "<input type=hidden name=\"alkis_fl_stat\" value=\"$r[alkis_fl_stat]\">";
    }
 echo "</td>

</tr>
</table><br><br>";


echo "<table border=1>
      <tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
      <td bgcolor=\"#ECD513\" colspan=\"2\">Einarbeitung des Werkvertrages</td>
      </tr>
      <tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
      <td bgcolor=\"#ECD513\">Restfehler vorhanden:</td>
      <td><select name=\"alkis_restf\">
      <option ";
      if ($r[alkis_restf] == '0') echo "selected";
      echo " value=\"0\">nein</option>
      <option ";
      if ($r[alkis_restf] == '1') echo "selected";
      echo " value=\"1\">ja</option>
      </select>
      </td></tr>
      </table>";

################################ab hier Spalte 2


echo "</td>
<td>&nbsp;&nbsp;</td>
<td>
<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">";

#######################Migrations-Auftrag erstellen

if ((strpos($abteilung,"akt1") > -1 OR strpos($abteilung,"adm") > -1 OR strpos($abteilung,"akt1") > -1)) 
  if ($r[alkis_mig_anr] == '0')
    echo "<td bgcolor=\"#ECD513\"><a href=\"flur_create_anr.php?gemkg_id=$r[gemkg_id]&flur_id=$r[flur_id]&case=mig&id=$id\">
    Migrations-Antrag erstellen</a></td>";
  else
    echo "<td bgcolor=\"#ECD513\">Migrations-Antrag: $migaz&nbsp;
         <a href=\"flur_ant_suchen.php?id=$r[alkis_mig_anr]\">
         <img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a></td>";
 else  
  if ($r[alkis_mig_anr] == '0')
    echo "<td bgcolor=\"#ECD513\">kein Migrations-Antrag</td>";
  else
    echo "<td bgcolor=\"#ECD513\">Migrationss-Auftrag: $migaz&nbsp;
         <a href=\"flur_ant_suchen.php?id=$r[alkis_mig_anr]\">
        <img src=\"images/buttons/s_info.png\" alt=\"Zum Antrag\" border=\"0\"></a></td>";

 echo "</tr></table><br>";

if ($r[alkis_restf] == '1') echo "<font face=arial><marquee>(Restfehler beachten!!)</marquee><br><br></font>";

##############################Abgleich ALK-ALB
echo "<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">ALKIS-Vormigration<br>Stufe 1 Abgleich ALB-ALK</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_albalk_dat\" value=\"$r[alkis_albalk_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_albalk_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_albalk_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">Status</td>
<td><select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_albalk_stat\">
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_albalk_stat]==0)
    {
    echo " selected";
    }
    echo " value=\"0\">keine Aktion</option>
   <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_albalk_stat]==1)
    {
    echo " selected";
    }
    echo " value=\"1\">abgeschlossen</option>
    <option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r[alkis_albalk_stat]==2)
    {
    echo " selected";
    }
    echo " value=\"2\">&Uuml;berhaken entfernen</option>
    </select></td>
</tr>

</table><br>

<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">Aktualisierung der Stufe 1</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_akt1_dat\" value=\"$r[alkis_akt1_dat]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_akt1_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%akt1%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_akt1_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td> 
</tr>";
if ($r[alkis_akt1_dat] > '0000-00-00' AND $r[alkis_feldnutz_stat] > 0 AND ($r[alkis_fl_stat] =='1' OR $r[alkis_fl_stat] =='4' OR $r[alkis_fl_stat] =='5'))
  {
   echo "<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold; color: red\">
<td bgcolor=\"#ECD513\" text=\"#FF0000\" colspan=\"2\" align=\"center\">abgeschlossen</td>
</tr>";
   }

echo "</table><br>



<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">ALKIS-Vormigration<br>Stufe 2</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_st2_date\" value=\"$r[alkis_st2_date]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_st2_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_st2_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>

</table>
<br>

<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">ALKIS-Vormigration<br>Stufe 2b (alle Knickpunkte entfernt)</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_knick_date\" value=\"$r[alkis_knick_date]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_knick_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_knick_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>

</table>
<br>
<table border=\"1\">
<tr style=\"font-family:Arial; font-size: 12pt; font-weight: bold\">
<td bgcolor=\"#ECD513\" colspan=\"2\">ALKIS-Testmigration<br>Stufe 3</td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">abgeschlossen am:</td>
<td><input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"date\" name=\"alkis_st3_date\" value=\"$r[alkis_st3_date]\" size=\"10\" ></td>
</tr>
<tr style=\"font-family:Arial; font-size: 10pt; font-weight: bold\">
<td width=\"300\" bgcolor=\"#ECD513\">Mitarbeiter:</td>
<td>
 <select  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" name=\"alkis_st3_mitid\">";

 $query5="SELECT * FROM mitarbeiter WHERE abteilung LIKE '%vbk%'";
 $result5=mysql_query($query5);

 while($r5=mysql_fetch_array($result5))
   {
   echo "<option style=\"font-family:Arial; font-size: 10pt; font-weight: bold\"";
   if($r5[mitarb_id] == $r[alkis_st3_mitid])
   {
   echo " selected";
   }
   echo " value=\"$r5[mitarb_id]\">$r5[name]</option>\n";
   }
   echo "
      </select>
 </td>
</tr>

</table>
</td></tr>
</table>
<br>";
  if ((strpos($abteilung,"akt1") > -1 OR strpos($abteilung,"adm") > -1 OR strpos($abteilung,"vbk") > -1)) 
    echo "<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"Submit\" value=\"&Auml;nderungen eintragen\">&nbsp;<input  style=\"font-family:Arial; font-size: 10pt; font-weight: bold\" type=\"reset\">";
echo "</form>";
echo "<br><br>";



nav_flur("alkis");
bottom();
?>