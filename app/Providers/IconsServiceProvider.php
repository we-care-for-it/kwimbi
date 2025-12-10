<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class IconsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::anonymousComponentPath(__DIR__.'/../../vendor/blade-ui-kit/blade-heroicons/resources/svg', 'heroicon');
    }
}