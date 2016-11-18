<?php

/*
 * This file is part of Laravel LeagueApi.
 *
 * (c) Manuel Strebel <manuel@strebel.xyz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | League of Legends API Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify your League of Legends API connection.
    | You probably just need the main connection.
    |
    */
    'connections' => [

        'main' => [

            /*
            |--------------------------------------------------------------------------
            | League of Legends API Key
            |--------------------------------------------------------------------------
            |
            | Here you may specify your League of Legends API key which
            | you optained from https://developer.riotgames.com/
            |
            */
            'api-key' => env('LOL_API_KEY'),

            /*
            |--------------------------------------------------------------------------
            | API Rate Limits
            |--------------------------------------------------------------------------
            |
            | Here you configure the rate limits for your API key.
            | The default configuration is prepared for a
            | standard development API key.
            |
            */

            'rate-limits' => [

                [
                    'requests' => 10,
                    'per_seconds' => 10,
                ],

                [
                    'requests' => 500,
                    'per_seconds' => 600,
                ],

            ],

        ],

        'alternative' => [
            'api-key' => 'your-alternative-key',
            'rate-limits' => [],
        ],

    ],

];
