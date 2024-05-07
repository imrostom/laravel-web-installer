<?php

namespace Imrostom\LaravelWebInstaller\Http\Controllers;

use Illuminate\Routing\Controller;
use Imrostom\LaravelWebInstaller\Library\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private DatabaseManager $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     */
    public function index()
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelWebInstaller::final')->with(['message' => $response]);
    }
}
