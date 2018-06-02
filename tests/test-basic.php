<?php
require(__DIR__ . "/../vendor/autoload.php");
use \kargirwar\Barcoder\Barcoder;
main();

function main()
{
        print_r(Barcoder::encodeCode128C("123"));
        
}
