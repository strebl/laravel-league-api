<?php

/*
 * This file is part of Laravel LeagueApi.
 *
 * (c) Manuel Strebel <manuel@strebel.xyz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Strebl\LeagueApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the LeagueApi facade class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'league-api';
    }
}