<?php

namespace Ibnuhalimm\LaravelTripay;

use Ibnuhalimm\LaravelTripay\Concerns\ConfigRepository;
use Illuminate\Contracts\Config\Repository as IlluminateRepository;

class ConfigManager implements IlluminateRepository
{
    use ConfigRepository;

    /**
     * Config items.
     */
    protected $items;

    /**
     * Create new instance.
     *
     * @param  array  $items  Config items.
     * @return void
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}