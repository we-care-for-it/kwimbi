<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SetTenantContext
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)
            ->where('is_active', 1)
            ->first();

        if (!$tenant) {
            abort(404, 'Tenant not found.');
        }

        Cache::put('tenant', $tenant);

        Config::set('database.connections.tenant', [
            'driver' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $tenant->database,
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        Config::set('database.default', 'tenant');
        DB::setDefaultConnection('tenant');

        Config::set('app.url', $tenant->domain);

        $tenant_code = $tenant->code;
        $tenantDiskName = 'tenant_' . $tenant_code;
        $tenantPath = storage_path('app/tenants/' . $tenant_code);

        if (!file_exists($tenantPath)) {
            mkdir($tenantPath, 0755, true);
        }

        Config::set("filesystems.disks.$tenantDiskName", [
            'driver' => 'local',
  
              'root' => storage_path("app/tenants/{$tenant->code}"),
    'url' => "http://{$tenant->domain}/tenants/{$tenant->code}",
        ]);

        Config::set('filesystems.default', $tenantDiskName);

        return $next($request);
    }
}
