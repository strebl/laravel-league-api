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

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the LeagueApi Api manager class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApiManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Strebl\LeagueApi\LeagueApiFactory
     */
    private $factory;

    /**
     * Create a new LeagueApi Api manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Strebl\LeagueApi\LeagueApiFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, LeagueApiFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'league-api';
    }

    /**
     * Get the factory instance.
     *
     * @return \Strebl\LeagueApi\LeagueApiFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
