<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/admin.css'),
        ]);

         
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    
                    ->url(route('filament.admin.general'))
                    ->icon('heroicon-o-cog-6-tooth'),
                // ...
            ]);

            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    
                    ->url(route('filament.admin.general'))
                    ->icon('heroicon-o-cog-6-tooth'),
                // ...
            ]);


        });

        Model::unguard();
    }
}
