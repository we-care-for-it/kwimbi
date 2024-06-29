<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
 
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any appli
     * 
     * 
     * cation services.
     */

     
    public function register(): void
    {


        
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
        ]);
        
        
        
      Schema::defaultStringLength(191);
     
    }
}
