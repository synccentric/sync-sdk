<?php
require_once 'vendor/autoload.php';

use SyncSDK\Synccentric;
use SyncSDK\Adapter\GuzzleHttpAdapter;

$token = 'your-synccentric-token';

$client = new Synccentric($token);

$options = [
	'fields' => ['asin', 'upc', 'model'],
];

$productId = 18;

try {
	$product = $client->listProduct($productId, $options);
} catch (\SyncSDK\Exceptions\SynccentricException $e) {
	$errors = $e->getErrorResponse();
	$errors = $errors->getErrors();

	print_r($errors);

	die("\n");
}

// Return an array of all properties
$response = $product->getProperties();

// Return array of attributes
// $response = $product->getAttributes();

print_r($response);