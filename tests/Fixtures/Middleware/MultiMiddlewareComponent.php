<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures\Middleware;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/multi-middleware', middleware: ['auth', 'verified'])]
class MultiMiddlewareComponent extends Component
{
    public function render() { return 'ok'; }
}
