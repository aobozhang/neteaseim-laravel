<?php namespace Aobo\Neteaseim\Facades;

use Illuminate\Support\Facades\Facade;

class Nim extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'neteaseim';
    }
}
