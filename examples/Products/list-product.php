<?php
require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;
use SyncSDK\Adapter\GuzzleHttpAdapter;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

$options = [
	'fields' => ['asin', 'upc', 'model'],
];

try {
	$products = $client->listProducts($options);
} catch(\SyncSDK\Exceptions\SynccentricException $e) {
	$errors = $e->getErrorResponse();
	$errors = $errors->getErrors();

	print_r($errors);

	die("\n");
}

// If you want an array of objects that have a bit more information.
//$response = $products->getData();

// If you just want an array back of the attributes
//$response = $products->toArray();

print_r($response);