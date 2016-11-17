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
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the LeagueApi service provider class.
 *
 * @author Manuel Strebel <manuel@strebel.xyz>
 */
class LeagueApiServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/league-api.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('league-api.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('league-api');
        }

        $this->mergeConfigFrom($source, 'league-api');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('league-api.factory', function () {
            return new LeagueApiFactory();
        });

        $this->app->alias('league-api.factory', LeagueApiFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('league-api', function (Container $app) {
            $config = $app['config'];
            $factory = $app['league-api.factory'];

            return new LeagueApiManager($config, $factory);
        });

        $this->app->alias('league-api', LeagueApiManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('league-api.connection', function (Container $app) {
            $manager = $app['league-api'];

            return $manager->connection();
        });

        $this->app->alias('league-api.connection', Api::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'league-api',
            'league-api.factory',
            'league-api.connection',
        ];
    }
}
