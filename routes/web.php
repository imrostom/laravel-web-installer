<?php

use Illuminate\Support\Facades\Route;
use Imrostom\LaravelWebInstaller\Http\Controllers\DatabaseController;
use Imrostom\LaravelWebInstaller\Http\Controllers\EnvironmentController;
use Imrostom\LaravelWebInstaller\Http\Controllers\FinalController;
use Imrostom\LaravelWebInstaller\Http\Controllers\PermissionsController;
use Imrostom\LaravelWebInstaller\Http\Controllers\RequirementController;
use Imrostom\LaravelWebInstaller\Http\Controllers\WelcomeController;

Route::group(['prefix' => 'install', 'as' => 'LaravelWebInstaller::', 'middleware' => ['web', 'installed']], function () {

    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('requirement', [RequirementController::class, 'index'])->name('requirement');
    Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions');

    Route::get('environment', [EnvironmentController::class, 'index'])->name('environment');
    Route::post('environment', [EnvironmentController::class, 'save'])->name('environment.save');

    Route::get('database', [DatabaseController::class, 'index'])->name('database');
    Route::get('final', [FinalController::class, 'index'])->name('final');
});