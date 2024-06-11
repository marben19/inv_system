<?php
require 'vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorPNG();

extract($_POST);

echo json_encode(["barcode" => '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128, 3, 100)) . '">']);

?>