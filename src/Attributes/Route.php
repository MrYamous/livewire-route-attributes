<?php

namespace Yamous\LivewireRouteAttributes\Attributes;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
class Route
{
    /**
     * @param string $uri
     * @param string $name
     * @param string|string[] $methods
     * @param string[] $middleware
     */
    public function __construct(
        public string $uri,
        public array|string $methods = [],
        public ?string $name = null,
        public array $middleware = [],
    ) {}
}
