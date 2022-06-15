<?php

namespace Ibnuhalimm\LaravelTripay\Requests;

use GuzzleHttp\Client;
use Ibnuhalimm\LaravelTripay\BaseApi;
use Ibnuhalimm\LaravelTripay\Exceptions\InvalidConfig;
use Ibnuhalimm\LaravelTripay\Payment;

class HttpClient
{
    /** @var GuzzleHttp/Client */
    protected $http;

    /** @var array */
    protected $headerOptions = [];

    /**
     * Create new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->http = new Client([
            'base_uri' => BaseApi::getBaseUrl()
        ]);

        $this->headerOptions = $this->getDefaultHeaders();
    }

    /**
     * Call the API.
     *
     * @param  string  $method
     * @param  string  $endPoint
     * @param  array  $payload
     * @param  array  $headers
     * @return mixed
     */
    public function call(string $method, string $endPoint, array $payload = [], array $headers = [])
    {
        $headerOptions = $this->mergeHeaders($headers);

        $requestOptions = [
            'headers' => $headerOptions,
            'json' => $payload
        ];

        if ($method == 'GET' && !empty($payload)) {
            unset($requestOptions['json']);
            $requestOptions['query'] = $payload;
        }

        $response = $this->http->request($method, $endPoint, $requestOptions);

        return json_decode($response->getBody()->getContents(), false);
    }

    /**
     * Request the API with use POST method.
     *
     * @param  string  $endPoint
     * @param  array  $payload
     * @param  array  $headers
     * @return mixed
     */
    public function post(string $endPoint, array $payload = [], array $headers = [])
    {
        return $this->call('POST', $endPoint, $payload, $headers);
    }

    /**
     * Request the API with use GET method.
     *
     * @param  string  $endPoint
     * @param  array  $urlParams
     * @param  array  $headers
     * @return mixed
     */
    public function get(string $endPoint, array $urlParams = [], array $headers = [])
    {
        return $this->call('GET', $endPoint, $urlParams, $headers);
    }

    /**
     * Get default headers
     *
     * @return array
     * @throws InvalidConfig
     */
    public function getDefaultHeaders()
    {
        if (empty(config('laravel-tripay.api_key'))) {
            throw InvalidConfig::missingApiKey();
        }

        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => 'laravel-midtrans-' . Payment::VERSION,
            'Authorization' => 'Bearer ' . config('laravel-tripay.api_key', '')
        ];
    }

    /**
     * Merge the default and incoming headers.
     *
     * @param  array  $headers
     * @return array
     */
    public function mergeHeaders(array $headers = [])
    {
        $defaultHeaders = $this->getDefaultHeaders();

        return collect(array_merge($defaultHeaders, $headers))->mapWithKeys(function ($value, $name) {
            return [$name => $value];
        })->all();
    }
}