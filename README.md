# Livewire Route Attribute

A Laravel package to declare Livewire routes using PHP attributes.

Inspired by [spatie/laravel-route-attributes](https://github.com/spatie/laravel-route-attributes) and [Symfony routing](https://symfony.com/doc/current/routing.html), this package brings a declarative route definition approach to Livewire components.

Here's a quick example:

```php
use Yamous\LivewireRouteAttributes\Attributes\Route;

class DefaultController
{
    #[Route(uri: 'index', methods: 'GET', name: 'default.index')]
    public function index()
    {
    }
}
```

## Testing

``` bash
composer test
```

## Credits

- [Matthieu Lempereur](https://github.com/MrYamous)

This package is inspired by :
- [spatie/laravel-route-attributes](https://github.com/spatie/laravel-route-attributes)
- [Symfony routing](https://symfony.com/doc/current/routing.html)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.