<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Imrostom\LaravelWebInstaller\Library\RequirementChecker;

class RequirementController extends Controller
{
    /**
     * @var RequirementChecker
     */
    protected RequirementChecker $requirements;

    /**
     * @param RequirementChecker $checker
     */
    public function __construct(RequirementChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return View
     */
    public function index()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(config('laravel-web-installer.core.minPhpVersion'));

        $requirements = $this->requirements->check(config('laravel-web-installer.requirements'));

        return view('LaravelWebInstaller::requirements', compact('requirements', 'phpSupportInfo'));
    }
}
