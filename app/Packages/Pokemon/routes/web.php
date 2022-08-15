<?php

use App\Packages\Acquire\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->prefix('acquire')
    ->group(static function () {
    Route::get('/', [PokemonController::class, 'index']);
});
