<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/form', name: 'form.submit', methods: ['GET', 'POST'])]
class FormComponent extends Component
{
    public function render()
    {
        return 'ok';
    }
}
