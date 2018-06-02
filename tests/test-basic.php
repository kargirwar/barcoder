<?php
require(__DIR__ . "/vendor/autoload.php");
use \kargirwar\Barcoder\Barcoder;
main();

function main()
{
        print_r(Barcoder::encode(Barcoder::CODE_128_C, "1234"));
        
}
