<?php
include ("connect_pgsql.php");
include ("connect.php");
include ("function.php");

$zdatei="/data/regis_dumps/flst_nenner_wrn.csv";
if ( !($zfhandle = fopen($zdatei,"w")))
    {
      die("Die Datei konnte nicht erstellt werden");
    }


  $query="SELECT gemkgschl,flurnr,flurstkennz from alb_flurstuecke ORDER BY flurstkennz";

  $result = $dbqueryp($connectp,$query);
  $count=0;

   while($r = $fetcharrayp($result))
    {
     $count++;
          

     $zaehler=substr($r[flurstkennz],11,5);
     $nenner=substr($r[flurstkennz],17,3);
     if ($zaehler != $merk_zaehler)        
	  {
	    $zeile=$r[gemkgschl].";".$r[flurnr].";";
        if ($count != 1)
          {
            $j=0;
            $mzaehler=$flur_id."-".$merk_zaehler;
            while ($merk_zaehler[$j] == '0')
              {
               $merk_zaehler[$j] = " ";
               $j++;
              }
        
            $merk_zaehler=trim($merk_zaehler);
            #echo $merk_zaehler;
		    $zeile=$zeile.$merk_zaehler;


            $j=0;
            while ($merk_nenner[$j] == '0')
             {
             $merk_nenner[$j] = " ";
             $j++;
             }
            $merk_nenner=trim($merk_nenner);
            $geschrieben=0;
            
            if (($geschrieben == '0') AND (strlen($merk_nenner) > 0))
       		#echo "/$merk_nenner";
			$zeile=$zeile."/".$merk_nenner;
			$zeile=$zeile."\n";
			fputs($zfhandle,$zeile);
	        #echo $zeile,"<br>";


        
        
        
        } #ende von if i!=1
     

       $merk_zaehler=$zaehler;
       $merk_nenner=$nenner;
	   
      } #ende merk_zaehler
	 
             
	  
    } #ende while-Schleife
	

fclose($zfhandle);



?>