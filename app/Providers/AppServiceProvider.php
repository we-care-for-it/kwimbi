<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/admin.css'),
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/tenant.css'),
        ]);

        Filament::serving(function () {
            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Instellingen')
                    ->url(route('filament.admin.general'))
                    ->icon('heroicon-s-cog'),

        
                    UserMenuItem::make()
                    ->label('Logboek')
                    ->url(route('filament.admin.logs'))
                    ->icon('heroicon-m-clipboard-document-list'),
                // ...
            ]);
        });


        Model::unguard();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}







