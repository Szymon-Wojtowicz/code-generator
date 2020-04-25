<?php

namespace Codes;

/**
 * Class CodeGenerator
 */
class CodeGenerator
{
    /** @var string */
    private $alphabet;

    /** @var int */
    private $alphabetLength;

    /** @var  array */
    private $codes;

    /** @var  int */
    private $numberOfCodes;

    /** @var  int */
    private $codeLength;


    /**
     * @param string $alphabet
     */
    public function __construct(int $numberOfCodes, int $codeLength, string $alphabet = '')
    {
        $this->codes = [];
        if ('' !== $alphabet) {
            $this->setAlphabet($alphabet);
        } else {
            $this->setAlphabet(
                implode(range('a', 'z'))
                . implode(range('A', 'Z'))
                . implode(range(0, 9))
            );
        }
        $this->codeLength = $codeLength;
        $this->numberOfCodes = $numberOfCodes;
        return $this;
    }

    /**
     * @return CodeGenerator
     */
    public function generate(): CodeGenerator
    {
        while (count($this->codes) < $this->numberOfCodes){      
            $this->addUniqueCode();
        }
        return $this;
    }

    /**
     * @return bool
     */
    private function addUniqueCode()
    {
        $code = $this->generateSingleCode();
        if (in_array($code, $this->codes)){
            return false;
        }else{
            $this->codes[] = $code;
        }
    }

    /**
     * @param string $alphabet
     * @return CodeGenerator
     */
    public function setAlphabet(string $alphabet): CodeGenerator
    {
        $this->alphabet = $alphabet;
        $this->alphabetLength = strlen($alphabet);
        return $this;
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateSingleCode()
    {
        $code = '';

        for ($i = 0; $i < $this->codeLength; $i++) {
            $randomKey = $this->getRandomInteger(0, $this->alphabetLength);
            $code .= $this->alphabet[$randomKey];
        }

        return $code;
    }


    /**
     * @return array
     */
    public function getCodes(): array
    {
        return $this->codes;
    }

    /**
     * @param array $codes
     * @return CodeGenerator
     */
    public function setCodes(array $codes): CodeGenerator
    {
        $this->codes = $codes;
        return $this;
    }


    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    private function getRandomInteger(int $min, int $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }
}