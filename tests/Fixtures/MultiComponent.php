<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/one', name: 'one')]
#[Route('/two', name: 'two')]
class MultiComponent extends Component
{
    public function render() { return 'ok'; }
}