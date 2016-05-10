<?php namespace Aobo\NeteaseIM\Facades;

use Illuminate\Support\Facades\Facade;

class NeteaseIM extends Facade
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
