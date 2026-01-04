<?php

namespace Yamous\LivewireRouteAttributes\Tests;

use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Yamous\LivewireRouteAttributes\LivewireRouteAttributesServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LivewireRouteAttributesServiceProvider::class,
        ];
    }

    public function getTestPath(?string $path = null): string
    {
        return __DIR__.($path ? DIRECTORY_SEPARATOR.$path : '');
    }
}