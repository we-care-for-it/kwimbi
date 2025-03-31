<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        http-equiv="refresh"
        content="30"
    >

    <link
        href="/favicon.png"
        rel="icon"
    >

    <title>{{ $code }} - {{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen overflow-y-auto bg-gray-100 text-gray-900">

    <div class="flex min-h-screen items-center justify-center bg-gray-100 py-12 text-gray-900">
        <div class="-mt-16 w-screen max-w-md space-y-8 px-6 md:mt-0 md:px-2">
            <div
                class="relative space-y-4 rounded-2xl border border-gray-200 bg-white/50 p-8 shadow-2xl backdrop-blur-xl">
                <div class="flex w-full justify-center">
                    <img
                        class="h-20 w-full"
                        src="https://assets.proculair.com/ikoreg/logo.svg"
                    />
                </div>

                <h2 class="text-center text-2xl font-bold tracking-tight">
                    {{ $title }}
                </h2>

                <p class="text-l text-center font-medium">
                    {{ $slot }}
                </p>

                @if (Flare::sentReports()->latestUuid())
                    <p class="text-center text-sm font-light tracking-tight">
                        {{ Flare::sentReports()->latestUuid() }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
