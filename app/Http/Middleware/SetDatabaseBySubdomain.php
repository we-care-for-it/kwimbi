<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetDatabaseBySubdomain
{
    public function handle($request, Closure $next)
    {
        $host      = $request->getHost(); // e.g., client1.example.com
        $subdomain = explode('.', $host)[0];

        $databaseMap = [
            'ltssoftware' => 'ltssoftware',
            'vlsmontage'  => 'vlsmontage',
        ];

        if (isset($databaseMap[$subdomain])) {
            // Dynamically set the DB connection
            Config::set('database.connections.tenant', [
                'driver'    => 'pgsql',
                'host'      => env('DB_HOST', '127.0.0.1'),
                'port'      => env('DB_PORT', '3306'),
                'database'  => $databaseMap[$subdomain],
                'username'  => env('DB_USERNAME', 'root'),
                'password'  => env('DB_PASSWORD', ''),
                'charset'   => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix'    => '',
                'strict'    => true,
                'engine'    => null,
            ]);

            // Set the default connection to "tenant"
            Config::set('database.default', 'tenant');
            DB::purge('tenant'); // Clears old connections if any
        }

        return $next($request);
    }

}
