<?php

namespace Ibnuhalimm\LaravelTripay\Exceptions;

use Exception;

class CallbackException extends Exception
{
    public static function invalidSignature()
    {
        return new static('Invalid callback signature');
    }

    public static function invalidCallbackEvent()
    {
        return new static('Invalid callback event, no action was taken');
    }
}