<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/anonymous', methods: ['GET'])]
class AnonymousComponent extends Component
{
    public function render() { return 'ok'; }
}
