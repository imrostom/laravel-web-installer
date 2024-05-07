<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return Response|View
     */
    public function index(): Response|View
    {
        return view('LaravelWebInstaller::welcome');
    }
}
