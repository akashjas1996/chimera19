<?php 

    include('phpqrcode/qrlib.php'); 
    include('config.php'); 

    // how to save PNG codes to server 
     
    $tempDir = EXAMPLE_TMP_SERVERPATH; 
     
    $codeContents = 'This Goes From File'; 
       $folder="cert/";
    $fileName = '005_file_'.md5($codeContents).'.png'; 
     
    //$pngAbsoluteFilePath = $tempDir.$fileName; 
    //$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName; 
     
   $pngpath=$folder.$file_name;
  if (!file_exists($pngpath)) { 
        QRcode::png($text, $pngpath); 
    }
    else { 
    }