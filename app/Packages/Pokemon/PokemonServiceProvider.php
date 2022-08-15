<?php

namespace Pokemon;

use Pokemon\Console\Commands\FetchPokemon;
use Pokemon\Http\Middleware\OnlyAjax;
use Illuminate\Support\ServiceProvider;

class PokemonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'acquire');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Console commands register
        $this->commands(
            [
                FetchPokemon::class
            ]
        );

        // Middleware register
        $router = $this->app['router'];
        $router->aliasMiddleware('only-ajax', OnlyAjax::class);

    }
}
