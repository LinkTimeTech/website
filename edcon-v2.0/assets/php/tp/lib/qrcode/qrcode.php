<?php

use Endroid\QrCode\QrCode;

require_once 'vendor/autoload.php';
$qrCode = new QrCode('Life is too short to be generating QR codes');
header('Content-Type: ' . $qrCode->getContentType());
$qrCode->setSize(200);
echo $qrCode->writeString();