<?php
require(__DIR__ . "/../vendor/autoload.php");
require('fpdf.php');
use \Kargirwar\Barcoder\Barcoder;
main();

function main()
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $barcode = Barcoder::encode(Barcoder::CODE_128_A, "1234XYZ");

    drawBarcode($pdf, 10, 10, 10, 1, $barcode);
    ob_start();
    $pdf->Output();
    file_put_contents("out.pdf", ob_get_clean());
}

function drawBarcode($pdf, $xOffset, $yOffset, $barHeight, $pixelsPerSymbol, $barcode) 
{
    $x = $xOffset;
    $y = $yOffset;

    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth($pixelsPerSymbol);

    foreach(str_split($barcode) as $s) {
        if ($s == "1") {
            $pdf->Line($x, $y, $x, ($y + $barHeight));
        }

        $x += $pixelsPerSymbol;
    }
}
