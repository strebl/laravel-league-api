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

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use LeagueWrap\Api;
use Strebl\LeagueApi\LeagueApiFactory;
use Strebl\LeagueApi\LeagueApiManager;

/**
 * This is the service provider test class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function setUp()
    {
        parent::setUp();

        putenv('LOL_API_KEY=your-api-key');
    }

    public function testLeagueApiFactoryIsInjectable()
    {
        $this->assertIsInjectable(LeagueApiFactory::class);
    }

    public function testLeagueApiManagerIsInjectable()
    {
        $this->assertIsInjectable(LeagueApiManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Api::class);

        $original = $this->app['league-api.connection'];
        $this->app['league-api']->reconnect();
        $new = $this->app['league-api.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
