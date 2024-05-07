<?php

namespace Imrostom\LaravelWebInstaller\Library;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EnvironmentManager
{
    /**
     * @var string
     */
    private string $envPath;

    /**
     * @var string
     */
    private string $envExamplePath;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent(): string
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Get the .env file path.
     *
     * @return string
     */
    public function getEnvPath(): string
    {
        return $this->envPath;
    }

    /**
     * Get the .env.example file path.
     *
     * @return string
     */
    public function getEnvExamplePath(): string
    {
        return $this->envExamplePath;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     * @return string
     */
    public function saveFileWizard(Request $request): string
    {
        try {
            $results = trans('LaravelWebInstaller::installer_messages.environment.success');

            file_put_contents($this->envPath, $this->generateEnvironmentFileContent($request));
        } catch (Exception $e) {
            $results = trans('LaravelWebInstaller::installer_messages.environment.errors');
        }

        return $results;
    }


    public function generateEnvironmentFileContent($request): string
    {
        // Build the environment file content
        $envFileContent = "APP_NAME='" . $request->get('app_name') . "'\n";
        $envFileContent .= "APP_ENV=" . $request->get('environment') . "\n";
        $envFileContent .= "APP_KEY=" . 'base64:' . base64_encode(Str::random(32)) . "\n";
        $envFileContent .= "APP_DEBUG=" . $request->get('app_debug') . "\n";
        $envFileContent .= "APP_URL=" . $request->get('app_url') . "\n\n";

        // Log configuration
        $envFileContent .= "LOG_CHANNEL=stack" . "\n";
        $envFileContent .= "LOG_DEPRECATIONS_CHANNEL=null" . "\n";
        $envFileContent .= "LOG_LEVEL=" . $request->get('app_log_level') . "\n\n";

        // Database configuration
        $envFileContent .= "DB_CONNECTION=" . $request->get('database_connection') . "\n";
        $envFileContent .= "DB_HOST=" . $request->get('database_hostname') . "\n";
        $envFileContent .= "DB_PORT=" . $request->get('database_port') . "\n";
        $envFileContent .= "DB_DATABASE=" . $request->get('database_name') . "\n";
        $envFileContent .= "DB_USERNAME=" . $request->get('database_username') . "\n";
        $envFileContent .= "DB_PASSWORD=" . $request->get('database_password') . "\n\n";

        // Broadcast, Cache, Session and Queue configuration
        $envFileContent .= "BROADCAST_DRIVER=log" . "\n";
        $envFileContent .= "CACHE_DRIVER=file" . "\n";
        $envFileContent .= "FILESYSTEM_DISK=local" . "\n";
        $envFileContent .= "QUEUE_CONNECTION=sync" . "\n";
        $envFileContent .= "SESSION_DRIVER=file" . "\n";
        $envFileContent .= "SESSION_LIFETIME=120" . "\n\n";

        //Memcached driver
        $envFileContent .= "MEMCACHED_HOST=127.0.0.1" . "\n\n";

        // Redis configuration
        $envFileContent .= "REDIS_HOST=" . $request->get('redis_hostname') . "\n";
        $envFileContent .= "REDIS_PASSWORD=" . $request->get('redis_password') . "\n";
        $envFileContent .= "REDIS_PORT=" . $request->get('redis_port') . "\n\n";

        // Mail configuration
        $envFileContent .= "MAIL_MAILER=" . $request->get('mail_driver') . "\n";
        $envFileContent .= "MAIL_HOST=" . $request->get('mail_host') . "\n";
        $envFileContent .= "MAIL_PORT=" . $request->get('mail_port') . "\n";
        $envFileContent .= "MAIL_USERNAME=" . $request->get('mail_username') . "\n";
        $envFileContent .= "MAIL_PASSWORD=" . $request->get('mail_password') . "\n";
        $envFileContent .= "MAIL_ENCRYPTION=" . $request->get('mail_encryption') . "\n";
        $envFileContent .= "MAIL_FROM_ADDRESS=hello@example.com" . "\n";
        $envFileContent .= "MAIL_FROM_NAME='" . $request->get('app_name') . "'\n\n";

        // AWS configuration
        $envFileContent .= "AWS_ACCESS_KEY_ID=" . "\n";
        $envFileContent .= "AWS_SECRET_ACCESS_KEY=" . "\n";
        $envFileContent .= "AWS_DEFAULT_REGION=us-east-1" . "\n";
        $envFileContent .= "AWS_BUCKET=" . "\n";
        $envFileContent .= "AWS_USE_PATH_STYLE_ENDPOINT=false" . "\n\n";


        // Pusher configuration
        $envFileContent .= "PUSHER_APP_ID=" . "\n";
        $envFileContent .= "PUSHER_APP_KEY=" . "\n";
        $envFileContent .= "PUSHER_APP_SECRET=" . "\n";
        $envFileContent .= "PUSHER_HOST=" . "\n";
        $envFileContent .= "PUSHER_PORT=443" . "\n";
        $envFileContent .= "PUSHER_SCHEME=https" . "\n";
        $envFileContent .= "PUSHER_APP_CLUSTER=mt1" . "\n\n";

        // Vite pushed configuration
        $envFileContent .= "VITE_APP_NAME='" . $request->get('app_name') . "'\n";
        $envFileContent .= "VITE_PUSHER_APP_KEY=" . "\n";
        $envFileContent .= "VITE_PUSHER_APP_SECRET=" . "\n";
        $envFileContent .= "VITE_PUSHER_HOST=" . "\n";
        $envFileContent .= "VITE_PUSHER_PORT=443" . "\n";
        $envFileContent .= "VITE_PUSHER_SCHEME=https" . "\n";
        $envFileContent .= "VITE_PUSHER_APP_CLUSTER=mt1" . "\n\n";

        return $envFileContent;
    }
}
