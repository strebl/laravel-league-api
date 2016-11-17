# Laravel LeagueApi

> A [League PHP / LeagueWrap](https://github.com/LeaguePHP/LeagueWrap) bridge for Laravel.

```php
// Set the region (default: na).
API::setRegion('euw');

// Get info about a summoner.
Summoner::info('liqy');

// Get the recent games for liqy.
Game::recent(Summoner::get('liqy'));
```

[![Build Status](https://img.shields.io/travis/strebl/laravel-league-api/master.svg?style=flat)](https://travis-ci.org/strebl/laravel-league-api)
[![StyleCI](https://styleci.io/repos/74075797/shield?style=flat)](https://styleci.io/repos/74075797)
[![Coverage Status](https://img.shields.io/codecov/c/github/strebl/laravel-league-api.svg?style=flat)](https://codecov.io/github/strebl/laravel-league-api)
[![Latest Version](https://img.shields.io/github/release/strebl/laravel-league-api.svg?style=flat)](https://github.com/strebl/laravel-league-api/releases)
[![License](https://img.shields.io/packagist/l/strebl/laravel-league-api.svg?style=flat)](https://packagist.org/packages/strebl/laravel-league-api)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require strebl/laravel-league-api
```

Add the service provider to `config/app.php` in the `providers` array.

```php
Strebl\LeagueApi\LeagueApiServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'LeagueApi' => Strebl\LeagueApi\Facades\LeagueApi::class
```

## Configuration

Laravel LeagueApi requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/league-api.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### LeagueApi Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

#### LeagueApiManager

This is the class of most interest. It is bound to the ioc container as `league-api` and can be accessed using the `Facades\LeagueApi` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `LeagueWrap\Api`.

#### Facades\Hashids

This facade will dynamically pass static method calls to the `league-api` object in the ioc container which by default is the `LeagueApiManager` class.

#### LeagueApiServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples
Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Strebl\LeagueApi\Facades\LeagueApi;

LeagueApi::summoner()->info('liqy');
// That's everything. It works!
```

The LeagueApi manager will behave like it is a `LeagueWrap\Api`. If you want to call specific connections, you can do that with the connection method:

```php
use Strebl\LeagueApi\Facades\Hashids;

// Writing this…
LeagueApi::connection('main')->summoner()->info('liqy');

// …is identical to writing this
LeagueApi::summoner()->info('liqy');

// and is also identical to writing this.
LeagueApi::connection()->summoner()->info('liqy');

// This is because the main connection is configured to be the default.
LeagueApi::getDefaultConnection(); // This will return main.

// We can change the default connection.
LeagueApi::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades, then you can inject the manager:

```php
use Strebl\LeagueApi\LeagueApiManager;

class Foo
{
	protected $leagueApi;

	public function __construct(LeagueApiManager $leagueApi)
	{
		$this->leagueApi = $leagueApi;
	}

	public function bar($name)
	{
		$this->leagueApi->summoner()->info($name);
	}
}

App::make('Foo')->bar();
```

## Documentation

There are other classes in this package that are not documented here. This is because the package is a Laravel wrapper of [League PHP's](https://github.com/LeaguePHP) [LeagueWrap package](https://github.com/LeaguePHP/LeagueWrap).

## License

[MIT](LICENSE) © [Manuel Strebel](https://strebel.xyz)

## ❤️

I used [Vincent Klaiber's](https://github.com/vinkla) packages as a base for this package. I really like his packages!
