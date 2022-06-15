<?php

namespace Ibnuhalimm\LaravelTripay;

class BaseApi
{
    /**
     * Base URL of the API
     *
     * @var string
     */
    const BASE_URL_SANDBOX = 'https://tripay.co.id/api-sandbox/';
    const BASE_URL_PRODUCTION = 'https://tripay.co.id/api/';

    /**
     * Endpoint lists
     *
     * @var string
     */
    const ENDPOINT_PAYMENT_CHANNEL = 'merchant/payment-channel';
    const ENDPOINT_FEE_CALCULATOR = 'merchant/fee-calculator';
    const ENDPOINT_TRANSACTION_LIST = 'merchant/transactions';
    const ENDPOINT_TRANSACTION_REQUEST = 'transaction/create';
    const ENDPOINT_TRANSACTION_DETAIL = 'transaction/detail';

    /**
     * Get base url depends on $isProduction value
     *
     * @return string
     */
    public static function getBaseUrl()
    {
        return (bool)config('laravel-tripay.production_mode')
            ? self::BASE_URL_PRODUCTION
            : self::BASE_URL_SANDBOX;
    }
}