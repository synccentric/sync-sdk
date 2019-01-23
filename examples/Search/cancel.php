<?php

// Cancel the current running product search, for current campaign or if campaign_id is passed
// then request a cancel for that particular campaign.

require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

try {
    $cancel = $client->cancelProductSearch();
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
    $errors = $e->getErrorResponse();

    print_r($errors);

    die("\n");
}

$response = $cancel->getProperties();

print_r($response);
