<?php
namespace Carkii\Notifier\facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Notifier extends IlluminateFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Carkii\Notifier';
    }
}
