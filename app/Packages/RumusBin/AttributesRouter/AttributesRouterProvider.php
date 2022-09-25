<?php

namespace RumusBin\AttributesRouter;

use Illuminate\Support\ServiceProvider;

class AttributesRouterProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        (new RouterLoader(app()->router))->loadControllers();
    }
}
