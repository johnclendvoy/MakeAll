<?php

namespace johnclendvoy\MakeAll\Facades;

use Illuminate\Support\Facades\Facade;

class MakeAll extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'makeall';
    }
}
