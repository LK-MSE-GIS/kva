<?php
include ("connect_pgsql.php");
include ("connect.php");
include ("function.php");

$gemarkung=$_GET["gemarkung"];
$flur=$_GET["flur"];

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

  $query="SELECT * from alb_fortfuehrung";

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
echo "<div align=\"center\"><b>Liste der höchsten Flurstücksnenner</b><br>
Gemarkung:",get_gemark_name($gemarkung,$dbname),"&nbsp;Flur:&nbsp;$flur<br><br>";
echo "<font size=\"-1\">Stand des ALB:$last_ff</font><br><br>";
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
        echo $merk_zaehler;


         $j=0;
         while ($merk_nenner[$j] == '0')
          {
          $merk_nenner[$j] = " ";
          $j++;
          }
          $merk_nenner=trim($merk_nenner);
          $geschrieben=0;
        for ($nindex=1;$nindex<=$nennercount;$nindex++)
          {
            if ($spnenner[$nindex][zaehler] == $mzaehler)
               { 
                 if ($spnenner[$nindex][nenner] > $merk_nenner)
                   {
                    $anzeige=$spnenner[$nindex][nenner]; 
                    echo "/$anzeige";
                    $geschrieben=1;
                   }

               }
                    

          }
        if (($geschrieben == '0') AND (strlen($merk_nenner) > 0)) echo "/$merk_nenner";


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
                    echo "/$anzeige";
                    $geschrieben=1;
                   }

               }
                    

          }
        if (($geschrieben == '0') AND (strlen($nenner) > 0)) echo "/$nenner";

        echo "</td>";
echo "</tr></table></font>";


?>