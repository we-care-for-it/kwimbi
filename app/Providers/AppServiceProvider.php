<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;

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
            Css::make('custom', __DIR__ . '/../../resources/css/custom.css'),
        ]);

        
// Filament::serving(function () {
//     Filament::registerNavigationItems([
//         NavigationItem::make('Basisgegevens')
//             ->url('/admin/settings')
//             ->icon('heroicon-o-cog-6-tooth')
//             ->activeIcon('heroicon-s-cog-6-tooth')
 
//             ->sort(3),
//     ]);
// });

        
        
        
      Schema::defaultStringLength(191);
     
    }
}
