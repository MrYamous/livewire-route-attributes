<?php

namespace Yamous\LivewireRouteAttributes\Tests\Fixtures;

use Livewire\Component;
use Yamous\LivewireRouteAttributes\Attributes\Route;

#[Route('/books', name: 'books.index', methods: ['GET'])]
class BooksComponent extends Component
{
    public function render() { return 'ok'; }
}
