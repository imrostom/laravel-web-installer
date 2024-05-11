<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DatabaseController extends Controller
{
    /**
     * Migrate and seed the database.
     *
     */
    public function index(Request $request)
    {
        try {
            $response = Http::post(config('green.author_url') . '/tracker/schema', $this->processPurchaseInfo($request));

            if ($response->successful() && $response->json('status')) {
                DB::unprepared($response->json('data'));

                return redirect()->route('LaravelWebInstaller::final')->with(['message' => $response->json('message')]);
            }


            return redirect()->route('LaravelWebInstaller::verify')->with(['message' => $response->json('message')]);
        } catch (Exception $e) {
            Log::error($e);


            return redirect()->route('LaravelWebInstaller::verify')->with(['message' => 'Something went wrong.']);
        }
    }


    /**
     * @param $request
     * @return array
     */
    private function processPurchaseInfo($request)
    {
        return [
            'code' => $_COOKIE['app_purchase_code'],
            'installed_host' => $request->schemeAndHttpHost(),
            'installed_ip' => $request->ip(),
            'app_name' => config('green.app_name'),
            'app_version' => config('green.app_version')
        ];
    }
}
