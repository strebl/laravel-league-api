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

use LeagueWrap\Api;
use Strebl\LeagueApi\LeagueApiFactory;

/**
 * This is the LeagueApi factory test class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApiFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getLeagueApiFactory();

        $return = $factory->make([
            'api-key' => 'your-api-key',
            'proxies' => true,
            'rate-limits' => [
                [
                    'requests'    => 20,
                    'per_seconds' => 20,
                ],
                [
                    'requests'    => 300,
                    'per_seconds' => 300,
                ],
            ],
        ]);

        $this->assertInstanceOf(Api::class, $return);

        collect($return->getLimits())->each(function($limit) {
            $this->assertTrue(
                $limit->remaining() == 20 || $limit->remaining() == 300
            );
        });
    }

    protected function getLeagueApiFactory()
    {
        return new LeagueApiFactory();
    }
}
