<?php

namespace Yamous\LivewireRouteAttributes;

use Illuminate\Routing\Router;
use Livewire\Component;
use Symfony\Component\Finder\Finder;
use Yamous\LivewireRouteAttributes\Attributes\Route as RouteAttribute;

class RouteRegistrar
{
    protected string $basePath;

    protected string $rootNamespace;

    public function __construct(
        protected Router $router,
    ) {}

    public function useBasePath(string $path): self
    {
        $this->basePath = rtrim($path, '/');

        return $this;
    }

    public function useRootNamespace(string $namespace): self
    {
        $this->rootNamespace = trim($namespace, '\\') . '\\';

        return $this;
    }

    public function registerDirectory(string $relativePath = ''): void
    {
        $path = $this->basePath . '/' . $relativePath;

        $files = (new Finder())
            ->files()
            ->in($path)
            ->name('*.php')
            ->sortByName();

        foreach ($files as $file) {
            $this->registerFile($file->getRealPath());
        }
    }

    public function registerFile(string $path): void
    {
        require $path;

        $class = $this->getFullyQualifiedClassName($path);

        if (!class_exists($class)) {
            return;
        }

        $this->registerRoutesForClass($class);
    }

    protected function getFullyQualifiedClassName(string $path): string
    {
        $realBase = realpath($this->basePath) . DIRECTORY_SEPARATOR;
        $realPath = realpath($path);

        $relativePath = str_replace($realBase, '', $realPath);
        $relativePath = str_replace('.php', '', $relativePath);

        return $this->rootNamespace . str_replace(DIRECTORY_SEPARATOR, '\\', $relativePath);
    }

    protected function registerRoutesForClass(string $class): void
    {
        $reflection = new \ReflectionClass($class);

        if (!$reflection->isSubclassOf(Component::class)) {
            return;
        }

        foreach ($reflection->getAttributes(RouteAttribute::class) as $attribute) {
            $route = $attribute->newInstance();

            $methods = is_array($route->methods)
                ? $route->methods
                : [$route->methods];

            $registered = $this->router->addRoute(
                $methods,
                ltrim($route->uri, '/'),
                [
                    'uses' => $class,
                    'controller' => $class,
                ],
            );

            if ($route->name) {
                $registered->name($route->name);
            }

            if ($route->middleware) {
                $registered->middleware($route->middleware);
            }
        }
    }
}
