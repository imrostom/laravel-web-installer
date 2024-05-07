<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Routing\Controller;
use Imrostom\LaravelWebInstaller\Library\EnvironmentManager;
use Imrostom\LaravelWebInstaller\Library\FinalInstallManager;
use Imrostom\LaravelWebInstaller\Library\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     */
    public function index(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall,
        EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        return view('LaravelWebInstaller::finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
