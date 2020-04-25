<?php

use Codes\CodeGenerator;

$numberOfCodes= $_GET['numberOfCodes'];
$lengthOfCode= $_GET['lengthOfCode'];

if ($numberOfCodes > 0 && $lengthOfCode > 0){
    try{
        require_once('libraries\Codes\CodeGenerator.php');
        $generator = new CodeGenerator((int)$numberOfCodes, (int)$lengthOfCode);
        $generatedCodes = $generator->generate()->getCodes();
        //save to file
        $file =  'codes.txt';
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/".$file,"wb");
        fwrite($fp,implode("\n", $generatedCodes));
        fclose($fp);

        //return file
        $attachment_location = $_SERVER['DOCUMENT_ROOT'] . "/".$file;
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: text/plain");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($attachment_location));
        header("Content-Disposition: attachment; filename=codes_".uniqid().".txt");
        readfile($attachment_location);
        die();
    }
    catch(\Exception $ex){
        echo "Error: ".$ex->getCode()." ".$ex->getMessage()." at file ".$ex->getFile()." line ".$ex->getLine();
        die();
    }
}
else{
    echo 'Arguments not set or <= 0';
}