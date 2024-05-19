<?php
namespace Imrostom\LaravelWebInstaller\Library;

class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return string
     */
    public function create(): string
    {
        $installedLogFile = storage_path('installed');

        $dateStamp = date('Y/m/d h:i:sa');

        if (! file_exists($installedLogFile)) {
            $message = trans('LaravelWebInstaller::installer_messages.installed.success_log_message').$dateStamp."\n";

            file_put_contents($installedLogFile, $message);
        } else {
            $message = trans('LaravelWebInstaller::installer_messages.installed.success_log_message').$dateStamp;

            file_put_contents($installedLogFile, $message.PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return $message;
    }
}
