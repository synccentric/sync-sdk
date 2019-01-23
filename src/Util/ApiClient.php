<?php

namespace SyncSDK\Util;

use GuzzleHttp\Client;
use GuzzleHttp\UriTemplate;
use SyncSDK\Response\ErrorResponse;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\BadResponseException;
use SyncSDK\Exceptions\SynccentricApiException;

class ApiClient
{
    const VERSION = '0.1.0';

    /**
     * @var mixed
     */
    private $client;

    /**
     * @param $token
     * @param $endpoint
     * @param array $clientOptions
     */
    public function __construct($token, $endpoint, $clientOptions = [])
    {
        $this->client = new Client(
            array_merge_recursive(
                [
                    'base_uri' => $endpoint,
                    'headers'  => [
                        'Authorization' => sprintf('Bearer %s', $token),
                        'Accept'        => 'application/json',
                    ],
                ], $clientOptions
            )
        );
    }

    /**
     * @param $partialUrl
     * @param array $uriParams
     * @param array $query
     * @param array $headers
     * @return mixed
     */
    public function delete($partialUrl, array $uriParams, array $query = [], array $headers = [])
    {
        return $this->request(
            'DELETE', $partialUrl, $uriParams, [
                'json'    => $query,
                'headers' => array_merge(
                    $headers, [
                        'Content-Type' => 'application/json',
                    ]
                ),
            ]
        );
    }

    /**
     * @param $partialUrl
     * @param array $uriParams
     * @param array $query
     * @return mixed
     */
    public function get($partialUrl, array $uriParams, array $query)
    {
        return $this->request(
            'GET', $partialUrl, $uriParams, [
                'json'    => $query,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]
        );
    }

    /**
     * @param $partialUrl
     * @param array $uriParams
     * @param array $query
     * @param array $headers
     * @return mixed
     */
    public function post($partialUrl, array $uriParams, array $query = [], array $headers = [])
    {
        return $this->request(
            'POST', $partialUrl, $uriParams, [
                'json'    => $query,
                'headers' => array_merge(
                    $headers, [
                        'Content-Type' => 'application/json',
                    ]
                ),
            ]
        );
    }

    /**
     * @param $partialUrl
     * @param array $uriParams
     * @param array $query
     * @return mixed
     */
    public function put($partialUrl, array $uriParams, array $query)
    {
        return $this->request(
            'PUT', $partialUrl, $uriParams, [
                'json'    => $query,
                'headers' => array_merge(
                    $headers, [
                        'Content-Type' => 'application/json',
                    ]
                ),
            ]
        );
    }

    /**
     * @param $method
     * @param $url
     * @param array $urlParams
     * @param array $options
     * @return mixed
     */
    private function request($method, $url, array $urlParams, array $options)
    {
        try {
            $uri      = new UriTemplate();
            $response = $this->client->request($method, $uri->expand($url, $urlParams), $options);
            if ($response->getStatusCode() === 204) {
                return [];
            }
            $body = \GuzzleHttp\json_decode($response->getBody(), true);

            return $body;
        } catch (ConnectException $e) {
            $errorResponse = new ErrorResponse(
                0, ['errors' => [
                    [
                        'message' => 'Could not communicate with ' . $this->client->getConfig('base_uri'),
                        'code'    => 'COMMUNICATION_ERROR',
                    ],
                ]]
            );
            throw new SynccentricApiRequest($errorResponse, $e);
        } catch (BadResponseException $e) {
            $body          = \GuzzleHttp\json_decode($e->getResponse()->getBody(), true);
            $errorResponse = new ErrorResponse($e->getResponse()->getStatusCode(), $body);
            throw new SynccentricApiException($errorResponse, $e);
        }
    }
}
