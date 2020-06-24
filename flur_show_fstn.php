<?php
include ("connect.php");
include ("connect_pgsql.php");
include ("function.php");

head_flur();
nav_flur("alkgrund");

$id=$_GET["id"];
$nachfolger=$id+1;
$vorgaenger=$id-1;
$query="SELECT * FROM flur WHERE ID=$id";
$result=mysql_query($query);
$r=mysql_fetch_array($result);
$gemarkung=$r[gemkg_id];
$flur=$r[flur_id];

flur_kopf($id,$dbname);
navi_flur("fstn",$id);
abhaken($r[ID],$dbname,"80",0);


while (strlen($flur) < 3)
 {
 $flur='0'.$flur;
  }

$flur_id=$gemarkung."-".$flur;
$query="SELECT * from nenner WHERE zaehler LIKE '$flur_id%';";

$result=mysql_query($query);
$nennercount=0;
 while($r=mysql_fetch_array($result))
   {
     $nennercount++;
     $spnenner[$nennercount]=$r;
    }


  echo "<font face=\"Arial\">";

  $query="SELECT * from alb_fortfuehrung ORDER BY lfdnr";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $ff[$count]=$r;
    }
$last_ff=$ff[$count][ffzeitraum_bis];

  $searchitem=$gemarkung."-".$flur;
  $query="SELECT * from alb_flurstuecke WHERE flurstkennz LIKE '$searchitem%' ORDER BY flurstkennz";

  $result = $dbqueryp($connectp,$query);
  $count=0;

  while($r = $fetcharrayp($result))
    {
     $count++;
     $treffer[$count]=$r;
    }
echo "<div align=\"center\"><b>Liste der höchsten Flurstücksnenner</b><br>";
echo "<font size=\"-1\">Stand des ALB:$last_ff</font><br>";
echo "
<a href=\"flur_fstn_alb.php?gemarkung=$gemarkung&flur=$flur\" target=\"about_blank\">Zur Druckversion</a><br><br>";
$fstn=0;
echo "<table><tr>";
for ($i=1;$i<=$count;$i++)
    {

     $zaehler=substr($treffer[$i][flurstkennz],11,5);
     $nenner=substr($treffer[$i][flurstkennz],17,3);
     if ($zaehler != $merk_zaehler)        {
        if ($i != 1)
        {
        $j=0;
        $mzaehler=$flur_id."-".$merk_zaehler;
        while ($merk_zaehler[$j] == '0')
         {
          $merk_zaehler[$j] = " ";
          $j++;
          }
        echo "<td width=\"80\">";
        $merk_zaehler=trim($merk_zaehler);
        $schreiben=0;
        for ($nindex=1;$nindex<=$nennercount;$nindex++)
          {
            if ($spnenner[$nindex][zaehler] == $mzaehler)
               { 
                 if ($spnenner[$nindex][nenner] > $merk_nenner)
                   {
                    $anzeige="/".$spnenner[$nindex][nenner]."*"; 
                    $schreiben=1;
                   }

               }
                    

          }

        if ($mitarb_id == '21' OR $mitarb_id == '16') echo "<a href=\"flur_spnenner_edit.php?zaehler=$mzaehler&id=$id\">$merk_zaehler</a>";
        else
        echo $merk_zaehler;

         $j=0;
         while ($merk_nenner[$j] == '0')
          {
          $merk_nenner[$j] = " ";
          $j++;
          }
          $merk_nenner=trim($merk_nenner);
          $geschrieben=0;

        if (($schreiben == '0') AND (strlen($merk_nenner) > 0)) echo "/$merk_nenner";
        if ($schreiben == '1') echo $anzeige;


        echo "</td>";
        $fstn=$fstn+1;
        $quot=$fstn%10;
        if($quot ==0) echo "</tr><tr>";
        }
        }

     $merk_zaehler=$zaehler;
     $merk_nenner=$nenner;
     }
        $mzaehler=$flur_id."-".$zaehler;
        $j=0;
        while ($zaehler[$j] == '0')
         {
          $zaehler[$j] = " ";
          $j++;
          }
        echo "<td width=\"80\">";
        $zaehler=trim($zaehler);
        if ($mitarb_id == '21' OR $mitarb_id == '16') echo "<a href=\"flur_spnenner_edit.php?zaehler=$mzaehler&id=$id\">$zaehler</a>";
        else
        echo $zaehler;


         $j=0;
         while ($nenner[$j] == '0')
          {
          $nenner[$j] = " ";
          $j++;
          }
          $nenner=trim($nenner);

          $geschrieben=0;
        for ($nindex=1;$nindex<=$nennercount;$nindex++)
          {
            if ($spnenner[$nindex][zaehler] == $mzaehler)
               { 
                 if ($spnenner[$nindex][nenner] > $merk_nenner)
                   {
                    $anzeige=$spnenner[$nindex][nenner]; 
                    echo "/$anzeige*";
                    $geschrieben=1;
                   }

               }
                    

          }
        if (($geschrieben == '0') AND (strlen($nenner) > 0)) echo "/$nenner";

        
        echo "</td>";
echo "</tr></table><br><br></font>";






nav_flur("alkgrund");
bottom();
?>