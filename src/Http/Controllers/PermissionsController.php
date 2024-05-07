<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Imrostom\LaravelWebInstaller\Library\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected PermissionsChecker $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return View
     */
    public function index()
    {
        $permissions = $this->permissions->check(
            config('laravel-web-installer.permissions')
        );

        return view('LaravelWebInstaller::permissions', compact('permissions'));
    }
}
