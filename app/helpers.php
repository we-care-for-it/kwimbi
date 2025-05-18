<?PHP

use App\Models\tenantSetting;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        static $settingsCache = [];

        if (array_key_exists($key, $settingsCache)) {
            return $settingsCache[$key];
        }

        $value = tenantSetting::where('key', $key)->value('value');

        return $settingsCache[$key] = $value ?? $default;
    }
}
