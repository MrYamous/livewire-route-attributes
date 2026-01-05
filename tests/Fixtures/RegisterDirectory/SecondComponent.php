<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures\RegisterDirectory;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/second-component', name: 'second-component.index')]
class SecondComponent extends Component
{
    public function render()
    {
        return 'ok';
    }
}
