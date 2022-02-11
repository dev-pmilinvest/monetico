<?php

namespace Pmilinvest\Monetico;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Pmilinvest\Monetico\Skeleton\SkeletonClass
 */
class MoneticoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'monetico';
    }
}
