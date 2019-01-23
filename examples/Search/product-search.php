<?php

// Initiate a product search of all the current products you have in either current campaign
// or if a campaign id is passed, in that particular campaign.

require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

//Product Search
try {
    $search = $client->productSearch();
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
    $errors = $e->getErrorResponse();

    print_r($errors);

    die("\n");
}

$response = $search->getProperties();

print_r($response);
