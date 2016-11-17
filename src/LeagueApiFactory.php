<?php

/*
 * This file is part of Laravel LeagueApi.
 *
 * (c) Manuel Strebel <manuel@strebel.xyz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Strebl\LeagueApi;

use LeagueWrap\Api;
use LeagueWrap\StaticApi;

/**
 * This is the LeagueWrap Api factory class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApiFactory
{
    /**
     * Make a new LeagueWrap Api client.
     *
     * @param array $config
     *
     * @return \LeagueWrap\Api
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        return [
            'api-key' => array_get($config, 'api-key', ''),
            'proxies' => array_get($config, 'proxies', true),
            'rate-limits' => array_get($config, 'rate-limits', []),
        ];
    }

    /**
     * Get the LeagueWrap Api client.
     *
     * @param array $config
     *
     * @return \LeagueWrap\Api
     */
    protected function getClient(array $config)
    {
        $api = new Api($config['api-key']);

        collect($config['rate-limits'])->each(function ($limit) use ($api) {
            $api->limit($limit['requests'], $limit['per_seconds']);
        });

        if ($config['proxies']) {
            StaticApi::mount();
        }

        return $api;
    }
}
