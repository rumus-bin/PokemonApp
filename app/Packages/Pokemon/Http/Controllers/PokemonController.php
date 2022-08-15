<?php

namespace App\Packages\Acquire\Http\Controllers;

use Pokemon\Repositories\PokemonRepository;
use Pokemon\Tools\Model\Paginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PokemonController
{
    public function __construct(
        private PokemonRepository $pokemonRepository
    ) {
    }

    public function index(Request $request)
    {
        return view('acquire::main');
    }
}
