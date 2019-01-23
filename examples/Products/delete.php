<?php

// If product_id is passed in options then delete that particular product.
// If no product_id is passed then all products in current campaign or if campaign_id is passed then
// delete all products in that particular campaign.

require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

$options = [
    'product_id' => 5,
];

try {
    $delete = $client->deleteProducts($options);
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
    $errors = $e->getErrorResponse();

    print_r($errors);

    die("\n");
}

$response = $delete->getProperties();

print_r($response);
