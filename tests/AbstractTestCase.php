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

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Strebl\LeagueApi\LeagueApiServiceProvider;

/**
 * This is the abstract test class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return LeagueApiServiceProvider::class;
    }
}
