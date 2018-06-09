<?php
namespace Kargirwar\Barcoder;

//https://en.wikipedia.org/wiki/Code_128
class Barcoder {
    const START_A = '11010000100';
    const START_A_VALUE = 103;
    const START_C = '11010011100';
    const START_C_VALUE = 105;
    const STOP = '1100011101011';
    const CODE_128_A = "CODE_128_A";
    const CODE_128_B = "CODE_128_B";
    const CODE_128_C = "CODE_128_C";

    public static function encode(string $type, string $input) {
        switch ($type) {
        case self::CODE_128_A:
            return self::encodeA($input);

        case self::CODE_128_C:
            return self::encodeC($input);

        default:
            throw new \Exception("$type is not supported");
        }
    }

    public static function encodeA(string $input) {
        $input = str_split($input);

        $barcode = "";
        $checksum = self::START_A_VALUE;
        $m = 1;

        foreach ($input as $i) {
            $symbol = Map::MAP_A[$i][1] ?? '';
            if (!$symbol) {
                throw new \Exception('Invalid input');
            }

            $barcode .= $symbol;
            $checksum += intval(MAP::MAP_A[$i][0]) * $m++;
        }

        $checksum = $checksum % 103;
        $checksum = Map::MAP_CODE_128[$checksum];

        $barcode = self::START_A . $barcode . $checksum . self::STOP;
        return $barcode;
    }

    public static function encodeC(string $input) {
        if (!is_numeric($input)) {
            throw new \Exception("Invalid input");
        }

        if (strlen($input) % 2) {
            throw new \Exception("Input length must be even");
        }

        $input = str_split($input);

        $barcode = "";
        $checksum = self::START_C_VALUE;
        $m = 1;

        for ($i = 0; $i < count($input); $i += 2) {
            $in = $input[$i] . $input[$i + 1];
            $symbol = Map::MAP_CODE_128[$in];
            if (!$symbol) {
                throw new \Exception('Invalid input');
            }

            $barcode .= $symbol;
            $checksum += intval($in) * $m++;
        }

        $checksum = $checksum % 103;
        if ($checksum < 10) {
            $checksum = "0" . $checksum;
        }
        $checksum = Map::MAP_CODE_128[$checksum];

        $barcode = self::START_C . $barcode . $checksum . self::STOP;
        return $barcode;
    }
}
