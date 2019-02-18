<?php

namespace Mortgage\Facades;

use Illuminate\Support\Facades\Facade;

class Annuity extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Annuity';
    }
}