<?php

$numberOfCodes = $_GET['numberOfCodes'];
$lengthOfCode = $_GET['lengthOfCode'];
// check before save to file if not passed arguments with value 0 (or less than 0)
if ($numberOfCodes > 0 && $lengthOfCode > 0) {
    try {

        require_once('CodeGenerator.php');
        $generator = new CodeGenerator();
        $rand_str = $generator->generate($_GET['numberOfCodes'], $_GET['lengthOfCode']);
        $generator->saveToFile($rand_str);

        // return file
        $attachment_location = "./tmp/codes.txt";
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: text/plain");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:" . filesize($attachment_location));
        header("Content-Disposition: attachment; filename=codes_" . uniqid() . ".txt");
        readfile($attachment_location);
        die();
    } catch (\Exception $ex) {
        echo "Error: " . $ex->getCode() . " " . $ex->getMessage() . " at file " . $ex->getFile() . " line " . $ex->getLine();
        die();
    }
} else {
    echo 'Arguments not set or <= 0';
} 