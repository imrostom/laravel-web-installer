<?php

namespace Imrostom\LaravelWebInstaller;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Imrostom\LaravelWebInstaller\Http\Middleware\IsInstalled;

class LaravelWebInstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Router $router): void
    {
         $this->loadTranslationsFrom(__DIR__.'/../lang', 'LaravelWebInstaller');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'LaravelWebInstaller');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

         $router->middlewareGroup('installed', [
             IsInstalled::class
         ]);


        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-web-installer.php' => config_path('laravel-web-installer.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('vendor/laravel-web-installer/views'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-web-installer'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../lang' => resource_path('vendor/laravel-web-installer/lang'),
            ], 'lang');

        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-web-installer.php', 'laravel-web-installer');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-web-installer', function () {
            return new LaravelWebInstaller;
        });
    }
}
