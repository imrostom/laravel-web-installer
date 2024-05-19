<?php

namespace Imrostom\LaravelWebInstaller\Library;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class FinalInstallManager
{
    /**
     * Run final commands.
     *
     * @return string
     */
    public function runFinal(): string
    {
        $outputLog = new BufferedOutput;

        $this->generateKey($outputLog);

        return $outputLog->fetch();
    }

    /**
     * Generate New Application Key.
     *
     * @param BufferedOutput $outputLog
     * @return void
     */
    private static function generateKey(BufferedOutput $outputLog): void
    {
        try {
            Artisan::call('key:generate', ['--force' => true], $outputLog);
        } catch (Exception $e) {
            static::response($e->getMessage(), $outputLog);
            return;
        }

    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param BufferedOutput $outputLog
     * @return void
     */
    private static function response($message, BufferedOutput $outputLog): void
    {
        [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}
