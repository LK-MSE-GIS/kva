<html>
<head>
<title>Rissnummern-Migration</title>
<meta name="author" content="Thurm">
<meta name="generator" content="Ulli Meybohms HTML EDITOR">
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#FF0000" alink="#FF0000" vlink="#FF0000">

<h2>Punktnummernimport</h2>
<br>
<br>
<?php

function display_formular( $file_max ) {
   
   $script = $_SERVER['PHP_SELF'];

   $form_value=<<<EOF
   
<form enctype="multipart/form-data" 
   action="$script"
   method="POST">

W&auml;hlen Sie eine Datei zum Upload aus:

<input type="hidden" name="MAX_FILE_SIZE" value="$file_max" />

<input name="upload" type="file" size="40"/>
<br />

<input name="submit" value="Weiter" type="submit" />

</form>
EOF;

   return $form_value;
}

$max_file_size = "204800";
$file_name = array();
$error = false;
$error_msg = "";
$download_dir = "/data/upload/";
$file_types = array();


// Eingang über das Formular
if ( !isset( $_FILES['upload'] ) && $_POST['submit'] !== "Submit") {
   
   $ret = display_formular( $max_file_size );
   echo $ret;
   
}
else {
   // Array mit Angaben ueber die Datei
   $file_name = $_FILES['upload'];
   echo $file_name[name];
   $kmq="4558".substr($file_name[name],0,4);
   
   // Dateigroesse der hochgeladenen Datei
   $file_size = $file_name['size'];
   
   // evtl. aufgetretener Fehler
   $error = $file_name['error'];
   
   // Wert aus der PHP.INI holen
   $ini_size = ini_get( "upload_max_filesize" );
   
   switch ( $error ) {
      case UPLOAD_ERR_FORM_SIZE:
         $error_msg = "Dateigr&ouml;&szlig;e > $ini_size Byte.";
         break;
         
      case UPLOAD_ERR_INI_SIZE:
         $error_msg = 
            "Datei gr&ouml;&szuml;er als in php.ini erlaubt.";
         break;
         
      case UPLOAD_ERR_NO_FILE:
         $error_msg = "Keine Datei &uuml;bertragen.";
         break;
         
      case UPLOAD_ERR_PARTIAL:
         $error_msg = "Datei nur teilweise &uuml;bertragen.";
         break;
         
      case UPLOAD_ERR_OK:
         if ( $file_size > $max_file_size ) {
            $error_msg = 
               "Dateigr&ouml;&szlig;e $file_size > $max_file_size Byte!";
         }
         break;
      default:
      
   }
   
   if ( !$error_msg ) {


      $new_file = $download_dir . $file_name['name'];

      // Falls die Datei schon existiert, evtl. umbenennen
      if ( !file_exists( $new_file ) ) {
         
         // aus dem Zwischenbereich holen
         if ( !move_uploaded_file( $file_name['tmp_name'], 
         $new_file ) ) {
            $info_msg = 
               "Fehler beim Speichern der Datei $file_name";
         }
         else {
            $info_msg ="Datei $new_file wurde hochgeladen.";
            echo "<head>
           <meta http-equiv=\"refresh\" content=\"0;      URL=migrate.php?dateiname=$new_file&kmq=$kmq\">
            </head>";
         }
      }
      else {
         $info_msg ="Die Datei $new_file existiert bereits.";
      }
      echo $info_msg;
   }
   else {
      echo $error_msg;
   }
   
}

?>

</body>
</html>

