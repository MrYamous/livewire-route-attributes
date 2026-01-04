<?php

namespace Yamous\LivewireRouteAttributes\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct(
        public string $uri,
        public array|string $methods = [],
        public ?string $name = null,
        public array $middleware = [],
    ) {}
}
