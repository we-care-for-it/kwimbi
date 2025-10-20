<?php
namespace App\Http\Middleware;

use App\Middleware\SetUserStoragePath;
use App\Models\Tenant;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetDatabaseBySubdomain
{
    public function handle($request, Closure $next)
    {

        Config::set('database.connections.mysql');
       $tenant = Tenant::where('domain', $request->getHost())->where('is_active', 1)->first();
        Cache::put('tenant', $tenant);
 

        Config::set('database.connections.tenant', [
             'driver'   => env('DB_CONNECTION'),
         'host'     => env('DB_HOST', '127.0.0.1'),
             'port'     => env('DB_PORT', '3306'),
             'database' => $tenant->database,
            'username' => env('DB_USERNAME', 'root'),
             'password' => env('DB_PASSWORD', ''),
             'prefix'   => '',
             'strict'   => true,
             'engine'   => null,
         ]);
         
        Config::set('database.default', 'tenant');
        Config::set('app.url', $tenant->domain);
        DB::setDefaultConnection('tenant');

        return $next($request);
    }

}
