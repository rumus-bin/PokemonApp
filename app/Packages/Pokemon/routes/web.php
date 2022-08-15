<?php

use Illuminate\Support\Facades\Route;
use Pokemon\Http\Controllers\PokemonController;

Route::middleware('web')
    ->prefix('pokemons')
    ->group(static function () {
        Route::get('/', [PokemonController::class, 'index']);
    });
