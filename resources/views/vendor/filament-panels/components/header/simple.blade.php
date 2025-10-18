@props([
    'heading' => null,
    'logo' => true,
    'subheading' => null,
])

<header class="fi-simple-header flex flex-col items-center pb-10">
    @if ($logo)
        <img 
            src="{{ setting('company_logo') ? Storage::url(setting('company_logo')) : asset('/images/logo-color.png') }}" 
            alt="Company Logo" 
            style = "max-height: 100px;"
            class="max-h-10 mb-4"
        >
    @endif

    @if (filled($heading))
        <h1 class="fi-simple-header-heading text-center text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
            {{ $heading }}
        </h1>
    @endif

    @if (filled($subheading))
        <p class="fi-simple-header-subheading mt-2 text-center text-sm text-gray-500 dark:text-gray-400">
            {{ $subheading }}
        </p>
    @endif
</header>
