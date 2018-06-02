A utility to create barcode representation of ASCII strings.
At present only Code 128 is supported. The utility only returns
encoded data in string. Actual rendering of the barcode is left to client.
Examples of drawing the barcode to PDF are provided.

# Dependencies
php 7+

# Installation
composer require kargirwar/barcoder

# Use
```php
require("/vendor/autoload.php");
use \kargirwar\Barcoder\Barcoder;
print_r(Barcoder::encode(Barcoder::CODE_128_C, "1234"));
```
Licence MIT.
