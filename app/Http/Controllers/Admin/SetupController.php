<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
{
    public function setup()
    {
        try {
            // Check if the setup has already been done
            if (file_exists(storage_path('app/setup_completed'))) {
                return response()->json(['message' => 'Setup has already been completed.'], 403);
            }

            // Run `storage:link`
            Artisan::call('storage:link');
            $storageLinkOutput = Artisan::output();

            // Run `migrate`
            Artisan::call('migrate', [
                '--force' => true, // Force running migrations in production
            ]);
            $migrateOutput = Artisan::output();

            // Run `db:seed`
            Artisan::call('db:seed', [
                '--force' => true, // Force seeding in production
            ]);
            $seedOutput = Artisan::output();

            // Mark setup as completed by creating a file
            file_put_contents(storage_path('app/setup_completed'), 'Setup completed at ' . now());

            // Return the outputs for debugging
            return response()->json([
                'message' => 'Setup completed successfully.',
                'storage_link' => $storageLinkOutput,
                'migrate' => $migrateOutput,
                'seed' => $seedOutput,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
