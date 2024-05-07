<?php

namespace Imrostom\LaravelWebInstaller;

use Illuminate\Support\Facades\Facade;

class LaravelWebInstallerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-web-installer';
    }
}
