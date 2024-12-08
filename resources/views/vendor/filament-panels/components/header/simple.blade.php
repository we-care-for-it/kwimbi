@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="fi-simple-header flex flex-col items-center">
<img src="{{ asset('storage/'.(\TomatoPHP\FilamentSettingsHub\Models\Setting::where('name', 'site_logo'))->first('payload')->payload) }}">
</header>
