# Laravel Web Installer

<a href="https://packagist.org/packages/imrostom/laravel-web-installer"><img src="https://img.shields.io/packagist/dt/imrostom/laravel-web-installer" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/imrostom/laravel-web-installer"><img src="https://img.shields.io/packagist/v/imrostom/laravel-web-installer" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/imrostom/laravel-web-installer"><img src="https://img.shields.io/packagist/l/imrostom/laravel-web-installer" alt="License"></a>

Laravel Web Installer is a Laravel package that allows you to install your application easily, without having to worry about setting up your environment before starting with the installation process.

## Installation

You can install the package via composer:

```bash
composer require imrostom/laravel-web-installer
```

## Usage
To publish web installer package assets [This must be required]
```bash
php artisan vendor:publish --provider="Imrostom\LaravelWebInstaller\LaravelWebInstallerServiceProvider" --tag="assets"
```

To publish web installer package config 
```bash
php artisan vendor:publish --provider="Imrostom\LaravelWebInstaller\LaravelWebInstallerServiceProvider" --tag="config"
```

To publish web installer package views
```bash
php artisan vendor:publish --provider="Imrostom\LaravelWebInstaller\LaravelWebInstallerServiceProvider" --tag="views"
```

To publish web installer package lang
```bash
php artisan vendor:publish --provider="Imrostom\LaravelWebInstaller\LaravelWebInstallerServiceProvider" --tag="lang"
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email rostomali4444@gmail.com instead of using the issue tracker.

## Credits

-   [Rostom Ali](https://github.com/imrostom)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
