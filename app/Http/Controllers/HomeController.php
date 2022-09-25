<?php

namespace App\Http\Controllers;


use App\Packages\RumusBin\AttributesRouter\RoteAttributes\Get;
use RumusBin\AttributesRouter\RouterLoader;

class HomeController extends Controller
{
    public function __construct(
        private RouterLoader $routerLoader
    ) {
    }

    #[Get('/')]
    public function index()
    {
        $this->routerLoader->loadControllers();
        return view('welcome');
    }
}
