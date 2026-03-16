<?php

use Midtrans\Config;
use Midtrans\Snap;

require __DIR__ . '/vendor/autoload.php';

// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];
Config::$isProduction = false;
Config::$isSanitized = true;
Config::$is3ds = true;

$params = [
    'transaction_details' => [
        'order_id' => 'TEST-' . time(),
        'gross_amount' => 10000,
    ]
];

try {
    echo "Attempting to get Snap Token...\n";
    $snapToken = Snap::getSnapToken($params);
    echo "Success! Snap Token: " . $snapToken . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
