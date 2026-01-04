<?php

use Illuminate\Support\Facades\Route;

it('can register a single file', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/BooksComponent.php')
    );

    $route = collect(Route::getRoutes())->first(fn ($r) =>
        $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\BooksComponent::class
    );

    expect($route)->not->toBeNull();
});

it('can register a route with multiple HTTP methods', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/FormComponent.php')
    );

    $route = collect(Route::getRoutes())
        ->first(fn ($r) => $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\FormComponent::class);

    expect($route)->not->toBeNull();
    expect($route->methods)->toContain('GET');
    expect($route->methods)->toContain('POST');
});

it('can register a route without a name', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/AnonymousComponent.php')
    );

    $route = collect(Route::getRoutes())
        ->first(fn ($r) => $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\AnonymousComponent::class);

    expect($route)->not->toBeNull();
    expect($route->getName())->toBeNull();
});

it('can register multiple routes on the same component', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/MultiComponent.php')
    );

    $routes = collect(Route::getRoutes())
        ->filter(fn ($r) => $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\MultiComponent::class);

    expect($routes)->toHaveCount(2);
    expect($routes->pluck('uri')->all())->toContain('one');
    expect($routes->pluck('uri')->all())->toContain('two');
});

it('can registrer a route with a single middleware', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/Middleware/OneMiddlewareComponent.php')
    );

    $route = collect(Route::getRoutes())->first(fn ($r) =>
        $r->uri === 'one-middleware'
    );

    expect($route)->not->toBeNull();
    expect($route->middleware())->toContain('auth');
});

it('can registrer a route with multiple middleware', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/Middleware/MultiMiddlewareComponent.php')
    );

    $route = collect(Route::getRoutes())->first(fn ($r) =>
        $r->uri === 'multi-middleware'
    );

    expect($route)->not->toBeNull();
    expect($route->middleware())->toMatchArray(['auth', 'verified']);
});

it('does not register a component without Route attribute', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/NoAttributeComponent.php')
    );

    $route = collect(Route::getRoutes())->first(fn ($r) =>
        $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\NoAttributeComponent::class
    );

    expect($route)->toBeNull();
});

it('does not register a class that is not a Livewire component', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/NotAComponent.php')
    );

    $route = collect(Route::getRoutes())->first(fn ($r) =>
        $r->uri === 'not-livewire'
    );

    expect($route)->toBeNull();
});

it('registers a route when methods is a string', function () {
    $this->routeRegistrar->registerFile(
        $this->getTestPath('Fixtures/MethodsAsStringComponent.php')
    );

    $route = collect(Route::getRoutes())
        ->first(fn ($r) => $r->getActionName() === \Yamous\LivewireRouteAttributes\Tests\Fixtures\MethodsAsStringComponent::class);

    expect($route)->not->toBeNull();
    expect($route->methods)->toContain('POST');
});

it('can register all components in a directory', function () {
    $this->routeRegistrar->registerDirectory('Fixtures/RegisterDirectory');

    $routes = collect(Route::getRoutes())
        ->filter(fn ($r) => str_starts_with($r->getActionName(), 'Yamous\LivewireRouteAttributes\Tests\Fixtures\RegisterDirectory'));

    expect($routes)->not->toBeEmpty();
    expect($routes->pluck('uri')->all())->toContain('first-component');
    expect($routes->pluck('uri')->all())->toContain('second-component');
});