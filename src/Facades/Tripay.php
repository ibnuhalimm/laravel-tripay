<?php

namespace Ibnuhalimm\LaravelTripay\Facades;

use Ibnuhalimm\LaravelTripay\Payment;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ibnuhalimm\LaravelTripay\Payment
 *
 * @method static mixed paymentChannels(?string $code = null)
 * @method static mixed feeCalculator(int $amount, ?string $paymentChannelCode = null)
 * @method static mixed transactions(?array $params = null)
 * @method static mixed createTransaction(array $params)
 * @method static mixed transactionDetails(string $reference)
 */
class Tripay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Payment::class;
    }
}
