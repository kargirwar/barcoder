<?php
require(__DIR__ . "/../vendor/autoload.php");
use \Kargirwar\Barcoder\Barcoder;
main();

function main()
{
        echo "Code A: " . Barcoder::encode(Barcoder::CODE_128_A, "1234XYZ") . "\n";
        echo "Code C: " . Barcoder::encode(Barcoder::CODE_128_C, "1234") . "\n";
        
}
