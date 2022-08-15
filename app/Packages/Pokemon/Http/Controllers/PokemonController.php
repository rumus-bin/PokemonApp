<?php

namespace Pokemon\Http\Controllers;

use Illuminate\Http\Request;

class PokemonController
{
    public function index(Request $request)
    {
        return view('pokemon::main');
    }
}
