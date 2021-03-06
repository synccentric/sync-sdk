<?php

namespace SyncSDK;

use SyncSDK\Model\Product;
use SyncSDK\Util\ApiClient;
use SyncSDK\Model\BaseModel;
use SyncSDK\Response\ListResponse;
use SyncSDK\Exceptions\SynccentricArgumentException;

class Synccentric
{
    /**
     * @var mixed
     */
    private $client;

    /**
     * @var mixed
     */
    private $token;

    /**
     * @param $token
     * @param null $endpoint
     */
    public function __construct($token = null, $endpoint = 'https://v3.synccentric.com/')
    {
        if ($token === null) {
            throw new SynccentricArgumentException('You need to specify your API token');
        }

        $this->token  = $token;
        $this->client = new ApiClient($token, $endpoint);
    }

    /**
     * @param array $options
     */
    public function cancelProductSearch(array $options = [])
    {
        $body = $this->client->post('/api/v3/product_search/cancel', [], $options);

        return new BaseModel([], $body);
    }

    /**
     * @param array $options
     */
    public function deleteProducts(array $options = [])
    {
        if (isset($options['product_id'])) {
            $body = $this->client->delete('/api/v3/products/{id}', ['id' => $options['product_id']], $options);
        } else {
            $body = $this->client->delete('/api/v3/products', [], $options);
        }

        return new Product($body);
    }

    /**
     * @param array $options
     */
    public function import(array $options)
    {
        if (! isset($options['identifiers'])) {
            throw new SynccentricArgumentException('You must specify the identifiers');
        }

        $body = $this->client->post('/api/v3/products', [], $options);

        return new BaseModel([], $body);
    }

    /**
     * @param $id
     * @param array $options
     */
    public function listProduct($id = null, array $options = [])
    {
        if ($id === null) {
            throw new SynccentricArgumentException('You must specify the id of the product.');
        }

        $body = $this->client->get('/api/v3/products/' . $id, [], $options);

        return new Product($body);
    }

    /**
     * @param array $options
     */
    public function listProducts(array $options = [])
    {
        $body = $this->client->get('/api/v3/products', [], $options);

        if (! empty($options['downloadable']) && $options['downloadable'] === true) {
            return new BaseModel([], $body);
        }

        return new ListResponse($body, function ($entry) {
            return new Product($entry);
        });
    }

    /**
     * @param array $options
     */
    public function productSearch(array $options = [])
    {
        $body = $this->client->post('/api/v3/product_search', [], $options);

        return new BaseModel([], $body);
    }

    /**
     * @param array $options
     */
    public function productSearchStatus(array $options = [])
    {
        $body = $this->client->get('/api/v3/product_search/status', [], $options);

        return new BaseModel([], $body);
    }
}
