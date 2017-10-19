<?php
namespace Maras0830\BattleNetApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ApiServiceFacade
 * @package Skmetaly\TwitchApi\Facades
 */
class ApiServiceFacade extends Facade{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'Maras0830\BattleNetApi\Services\ApiService'; }
}