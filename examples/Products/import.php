<?php
require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

// Type can be one of 'asin','upc','mpn','part-num','sku','ean','isbn','keyword'
// Must have type and identifier
$options = [
    'identifiers' => [
        ['type' => 'asin', 'identifier' => 'your-asin'],
        ['type' => 'asin', 'identifier' => 'your-asin'],
    ],
    'campaign_id' => 1,
];

try {
    $products = $client->import($options);
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
    $errors = $e->getErrorResponse();

    print_r($errors);

    die("\n");
}

$response = $products->getProperties();

print_r($response);
