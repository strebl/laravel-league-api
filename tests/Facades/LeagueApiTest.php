<?php

/*
 * This file is part of Laravel LeagueApi.
 *
 * (c) Manuel Strebel <manuel@strebel.xyz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Strebl\Tests\LeagueApi;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Strebl\LeagueApi\Facades\LeagueApi;
use Strebl\LeagueApi\LeagueApiManager;

/**
 * This is the LeagueApi facade test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class LeagueApiTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'league-api';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return LeagueApi::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return LeagueApiManager::class;
    }
}
