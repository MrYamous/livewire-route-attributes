<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures\RegisterDirectory;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/first-component', name: 'first-component.index')]
class FirstComponent extends Component
{
    public function render() { return 'ok'; }
}
