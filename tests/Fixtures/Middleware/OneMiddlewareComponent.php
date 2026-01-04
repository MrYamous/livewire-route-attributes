<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures\Middleware;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/one-middleware', middleware: ['auth'])]
class OneMiddlewareComponent extends Component
{
    public function render() { return 'ok'; }
}
