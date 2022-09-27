<?php

namespace App\Http\Controllers;


use RumusBin\AttributesRouter\src\RoteAttributes\Get;
use RumusBin\AttributesRouter\src\RouterLoader;

class HomeController extends Controller
{
    public function __construct(
        private RouterLoader $routerLoader
    ) {
    }

    #[Get('/')]
    public function index()
    {
        return view('welcome');
    }
}
