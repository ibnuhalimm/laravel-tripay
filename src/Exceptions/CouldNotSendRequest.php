<?php

namespace Ibnuhalimm\LaravelTripay\Exceptions;

use Exception;

class CouldNotSendRequest extends Exception
{
    public static function invalidAmountValue()
    {
        return new static('Amount cannot be empty');
    }
}