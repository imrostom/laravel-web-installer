<?php

namespace Imrostom\LaravelWebInstaller\Library;

use Exception;
use Illuminate\Support\Facades\Http;

class RequirementChecker
{
    /**
     * Minimum PHP Version Supported (Override is in installer.php config file).
     *
     */
    private string $_minPhpVersion = '8.0.0';

    /**
     * Check for the server requirements.
     *
     * @param array $systemRequirements
     * @return array
     */
    public function check(array $systemRequirements): array
    {
        $results = [];

        foreach ($systemRequirements as $type => $requirements) {
            switch ($type) {

                // check php requirements
                case 'internet':
                    foreach ($requirements as $requirement) {
                        $results['requirements'][$type][$requirement] = true;

                        if (!$this->internetConnection()) {
                            $results['requirements'][$type][$requirement] = false;

                            $results['errors'] = true;
                        }
                    }
                    break;

                // check php requirements
                case 'php':
                    foreach ($requirements as $requirement) {
                        $results['requirements'][$type][$requirement] = true;

                        if (!extension_loaded($requirement)) {
                            $results['requirements'][$type][$requirement] = false;

                            $results['errors'] = true;
                        }
                    }
                    break;

                // check apache requirements
                case 'apache':
                    foreach ($requirements as $requirement) {
                        // if function doesn't exist we can't check apache modules
                        if (function_exists('apache_get_modules')) {
                            $results['requirements'][$type][$requirement] = true;

                            if (!in_array($requirement, apache_get_modules())) {
                                $results['requirements'][$type][$requirement] = false;

                                $results['errors'] = true;
                            }
                        }
                    }
                    break;
            }
        }

        return $results;
    }

    /**
     * Check PHP version requirement.
     *
     * @param string|null $minPhpVersion
     * @return array
     */
    public function checkPHPversion(string $minPhpVersion = null): array
    {
        $minVersionPhp = $minPhpVersion;
        $currentPhpVersion = $this->getPhpVersionInfo();
        $supported = false;

        if ($minPhpVersion == null) {
            $minVersionPhp = $this->getMinPhpVersion();
        }

        if (version_compare($currentPhpVersion['version'], $minVersionPhp) >= 0) {
            $supported = true;
        }

        return [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minVersionPhp,
            'supported' => $supported,
        ];
    }

    /**
     * Get current Php version information.
     *
     * @return array
     */
    private static function getPhpVersionInfo(): array
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }

    /**
     * Get minimum PHP version ID.
     *
     * @return string _minPhpVersion
     */
    protected function getMinPhpVersion(): string
    {
        return $this->_minPhpVersion;
    }

    private function internetConnection(): bool
    {
        try {
            $response = Http::get('http://www.google.com', ['timeout' => 5]);

            return $response->status() === 200;
        } catch (Exception $e) {
            return false;
        }
    }
}
