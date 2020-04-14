<?php
namespace Newelement\PackageName\Facades;

use Illuminate\Support\Facades\Facade;

class Shoppe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'packagename';
    }
}
