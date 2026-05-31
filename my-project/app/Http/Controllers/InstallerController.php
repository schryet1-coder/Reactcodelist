<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class InstallerController extends Controller
{
    public function show()
    {
        if (app()->environment('production') && file_exists(base_path('.env'))) {
            return redirect('/')->with('message', 'Application already installed.');
        }

        return view('install');
    }

    public function install(Request $request)
    {
        $data = $request->validate([
            'db_host' => 'required|string',
            'db_port' => 'required|string',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
            'admin_name' => 'required|string',
            'admin_email' => 'required|email',
            'admin_password' => 'required|string|min:6',
        ]);

        // Write .env
        $envPath = base_path('.env');
        $envExample = base_path('.env.example');

        if (file_exists($envExample)) {
            $env = file_get_contents($envExample);
        } else {
            $env = "APP_NAME=Laravel\nAPP_ENV=production\nAPP_KEY=\nAPP_DEBUG=false\n";
        }

        // Replace or append DB values
        $env = preg_replace('/DB_HOST=.*/', "DB_HOST={$data['db_host']}", $env);
        $env = preg_replace('/DB_PORT=.*/', "DB_PORT={$data['db_port']}", $env);
        $env = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE={$data['db_database']}", $env);
        $env = preg_replace('/DB_USERNAME=.*/', "DB_USERNAME={$data['db_username']}", $env);
        $env = preg_replace('/DB_PASSWORD=.*/', "DB_PASSWORD={$data['db_password']}", $env);

        file_put_contents($envPath, $env);

        // run migrations
        try {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $e) {
            return back()->withErrors(['migrate' => $e->getMessage()]);
        }

        // create admin user
        $admin = User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => Hash::make($data['admin_password']),
            'is_admin' => true,
        ]);

        // mark installed
        try {
            file_put_contents(storage_path('installed'), now()->toDateTimeString());
        } catch (\Exception $e) {
            // ignore
        }

        return redirect('/')->with('message', 'Installation complete. Please login with the admin account.');
    }
}
