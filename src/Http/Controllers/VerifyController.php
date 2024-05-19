<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class VerifyController extends Controller
{
    /**
     * Display the Environment page.
     *
     * @return View
     */
    public function index()
    {
        return view('LaravelWebInstaller::verify');
    }

    /**
     * Processes the newly saved environment configuration (Form Wizard).
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase_code' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect(route('LaravelWebInstaller::verify'))->withErrors($validator)->withInput();
        }

        try {
            $response = Http::post(config('green.app_author_url') . '/tracker/verify', $this->processPurchaseInfo($request));

            if ($response->successful() && $response->json('status')) {
                setcookie('app_purchase_code', $request->get('purchase_code'), time() + 3600);

                return redirect(route('LaravelWebInstaller::environment'));
            }
        } catch (Exception $e) {
            Log::error($e);
        }

        return redirect(route('LaravelWebInstaller::verify'))->withErrors('You provide invalid purchase purchase code.')->withInput();
    }

    /**
     * @param $request
     * @return array
     */
    private function processPurchaseInfo($request)
    {
        return [
            'code' => $request->get('purchase_code'),
            'installed_host' => $request->schemeAndHttpHost(),
            'installed_ip' => $request->ip(),
            'app_name' => config('green.app_name'),
            'app_version' => config('green.app_version')
        ];
    }
}
