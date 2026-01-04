<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/methods-string', name: 'methods.string', methods: 'POST')]
class MethodsAsStringComponent extends Component
{
    public function render() { return 'ok'; }
}
