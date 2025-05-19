<?PHP

use App\Models\tenantSetting;
use Illuminate\Support\Facades\Schema;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        static $settingsCache = [];

        if (table_exists('tenant_settings')) {
            if (array_key_exists($key, $settingsCache)) {
                return $settingsCache[$key];
            }

            $value = tenantSetting::where('key', $key)->value('value');

            return $settingsCache[$key] = $value ?? $default;
        } else {
            // Table doesn't exist
        }

    }
}
