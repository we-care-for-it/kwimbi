@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="fi-simple-header flex flex-col items-center">
    @if ($logo)
        <x-filament-panels::logo class="mb-4" />
    @endif

</header>
