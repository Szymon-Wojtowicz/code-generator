<?php

class CodeGenerator {

    public $numberOfCodes;
    public $lengthOfCode;
    private $codes;

    public function __construct() {
        $this->codes = [];
        return $this;
    }

    public function generate($numberOfCodes, $lengthOfCode) {

        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 0; $i < $numberOfCodes; $i++) {
            $desired_length = $lengthOfCode;
            $code = '';
            while (strlen($code) < $desired_length) {
                $code .= substr(str_shuffle($charset), 0, 1);
            }
            // check if generated code was used before
            if (in_array($code, $this->codes)) {
                return false;
            } else {
                $this->codes[] = $code;
            }
        }
        return $this->codes;
    }

    // save generated codes to file
    public function saveToFile($rand_str, $file = 'codes.txt') {
    
        $fp = fopen("./tmp/" . $file, "wb");
        fwrite($fp, implode("</br>", $rand_str));
        fclose($fp);
    }

}