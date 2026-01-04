<?php

use Yamous\LivewireRouteAttributes\Tests\TestCase;
use Yamous\LivewireRouteAttributes\RouteRegistrar;

uses(TestCase::class)
    ->beforeEach(function () {
        $router = app()->router;

        $this->routeRegistrar = (new RouteRegistrar($router))
            ->useBasePath(__DIR__)
            ->useRootNamespace('Yamous\\LivewireRouteAttributes\\Tests\\');
    })
    ->in(__DIR__);