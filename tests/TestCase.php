<?php

namespace Tests;

use Ibnuhalimm\LaravelTripay\Facades\Tripay;
use Ibnuhalimm\LaravelTripay\TripayServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

abstract class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            TripayServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Tripay' => Tripay::class
        ];
    }
}