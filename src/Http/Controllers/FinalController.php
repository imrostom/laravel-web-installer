<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Routing\Controller;
use Imrostom\LaravelWebInstaller\Library\FinalInstallManager;
use Imrostom\LaravelWebInstaller\Library\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     */
    public function index(InstalledFileManager $fileManager, FinalInstallManager $finalInstall)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->create();

        return view('LaravelWebInstaller::finished', compact('finalMessages', 'finalStatusMessage'));
    }
}
