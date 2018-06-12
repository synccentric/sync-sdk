<?php

// Get the status of your current running product search.

require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;
use SyncSDK\Adapter\GuzzleHttpAdapter;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

//Product Search Status
try {
	$status = $client->productSearchStatus();
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
	$errors = $e->getErrorResponse();

	print_r($errors);

	die("\n");
}

$response = $status->getProperties();

print_r($response);