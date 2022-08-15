<?php

use Pokemon\Http\Controllers\Api\PokemonApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'only-ajax'])
    ->prefix('pokemons/api')
    ->group(static function () {
        Route::prefix('v1')->group(static function () {
            Route::apiResource('pokemons', PokemonApiController::class);
        });
});
