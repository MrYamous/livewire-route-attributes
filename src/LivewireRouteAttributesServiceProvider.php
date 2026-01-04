<?php

namespace Yamous\LivewireRouteAttributes;

use Illuminate\Support\ServiceProvider;
use Yamous\LivewireRouteAttributes\RouteRegistrar;

class LivewireRouteAttributesServiceProvider extends ServiceProvider
{
    public function boot(): void 
    {
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        if (! $this->shouldRegisterRoutes()) {
            return;
        }

        (new RouteRegistrar(app('router')))
            ->useBasePath(app_path())
            ->useRootNamespace('App\\')
            ->registerDirectory('Livewire');
    }

    private function shouldRegisterRoutes(): bool
    {
        if ($this->app->runningUnitTests()) {
            return false;
        }

        if ($this->app->routesAreCached()) {
            return false;
        }

        return true;
    }
}
