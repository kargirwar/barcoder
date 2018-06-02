<?php
namespace kargirwar\Barcoder;

class Barcoder {
    const CODE_128_C_START = '11010011100';
    const CODE_128_C_START_VALUE = 105;
    const CODE_128_C_STOP = '1100011101011';
    const CODE_128_A = "CODE_128_A";
    const CODE_128_B = "CODE_128_B";
    const CODE_128_C = "CODE_128_C";

    public static function encode(string $type, string $input) {
        switch ($type) {
        case self::CODE_128_C:
            return self::encodeCode128C($input);

        default:
            throw new \Exception("$type is not supported");
        }
    }

    public static function encodeCode128C(string $input) {
        if (!is_numeric($input)) {
            throw new \Exception("Invalid input");
        }

        if (strlen($input) % 2) {
            throw new \Exception("Input length must be even");
        }

        $input = str_split($input);

        $barcode = "";
        $checksum = self::CODE_128_C_START_VALUE;
        $m = 1;

        for ($i = 0; $i < count($input); $i += 2) {
            $in = $input[$i] . $input[$i + 1];
            $module = Map::MAP_CODE_128[$in];
            if (!$module) {
                throw new \Exception('Invalid input');
            }

            $barcode .= $module;
            $checksum += intval($in) * $m++;
        }

        $checksum = $checksum % 103;
        if ($checksum < 10) {
            $checksum = "0" . $checksum;
        }
        $checksum = Map::MAP_CODE_128[$checksum];

        $barcode = self::CODE_128_C_START . $barcode . $checksum . self::CODE_128_C_STOP;
        return $barcode;
    }
}
