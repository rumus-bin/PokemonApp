<?php

namespace RumusBin\AttributesRouter;

use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

class RouterLoader
{
    public function __construct(private  Router $router)
    {
    }

    public function loadControllers(): void
    {
        $path = app_path('Http/Controllers');
        $baseNamespace = 'App\Http\Controllers\\';
        collect($path)->each(function (string|array $directory, string|int $namespace) use (
            $path,
            $baseNamespace
        ) {
            $pathCheck = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $directory);
            $directories = [$pathCheck];
            $files = (new Finder())->files()->name('*.php')->in($directories)->sortByName();
            foreach ($files as $file) {
                if (is_string($file)) {
                    $file = new \SplFileInfo($file);
                }
                $class = trim(Str::replaceFirst($path, '', $file->getRealPath()), DIRECTORY_SEPARATOR);
                $class = str_replace(
                    [DIRECTORY_SEPARATOR, 'App\\'],
                    ['\\', app()->getNamespace()],
                    ucfirst(Str::replaceLast('.php', '', $class))
                );

                $classFQN = $baseNamespace . $class;
                $classReflection = new \ReflectionClass($classFQN);
                $methods = $classReflection->getMethods();
                foreach ($methods as $method) {
                    $attributes = $method->getAttributes();
                    if (empty($attributes)) {
                        continue;
                    }
                    $action = $method->getName() === '__invoke'
                        ? $classReflection->getName()
                        : [$classReflection->getName(), $method->getName()];
                    foreach ($attributes as $attribute) {
                        $attributeRouterInstance = $attribute->newInstance();
                        $this->router->addRoute(
                            $attributeRouterInstance->getMethods(),
                            $attributeRouterInstance->getRoutePath(),
                            $action
                        );
                    }
                }
            }
        });
    }
}
