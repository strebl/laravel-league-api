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

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use LeagueWrap\Api;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Strebl\LeagueApi\LeagueApiFactory;
use Strebl\LeagueApi\LeagueApiManager;

/**
 * This is the LeagueApi manager test class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApiManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('league-api.default')->andReturn('league-api');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Api::class, $return);

        $this->assertArrayHasKey('league-api', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(LeagueApiFactory::class);

        $manager = new LeagueApiManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('league-api.connections')->andReturn(['league-api' => $config]);

        $config['name'] = 'league-api';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Api::class));

        return $manager;
    }
}
