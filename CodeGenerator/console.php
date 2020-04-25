<?php

use Codes\CodeGenerator;

parse_str(implode('&', array_slice($argv, 1)), $_GET);
print('Generating codes');
$numberOfCodes = $_GET['numberOfCodes'];
$lengthOfCode = $_GET['lengthOfCode'];
$filename = $_GET['filename'];

if ($numberOfCodes > 0 && $lengthOfCode > 0){
    try{
        require_once('libraries\Codes\CodeGenerator.php');
        $generator = new CodeGenerator((int)$numberOfCodes, (int)$lengthOfCode);
        $generatedCodes = $generator->generate()->getCodes();

        //save to file
        $file =  $filename ?? "codes.txt";
        $fp = fopen($file,"wb");
        fwrite($fp,implode("\n", $generatedCodes));
        fclose($fp);
        print("Codes generated into ". $_SERVER['DOCUMENT_ROOT'] . "/".$file ." file");
        die();
    }
    catch(\Exception $ex){
        printf("Error: ".$ex->getCode()." ".$ex->getMessage()." at file ".$ex->getFile()." line ".$ex->getLine());
        die();
    }
}
else{
    printf("Arguments not set or <= 0");
}