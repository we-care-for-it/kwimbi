<?php

namespace App\Providers\Filament;

use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\FontProviders\SpatieGoogleFontProvider;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Filament\FontProviders\GoogleFontProvider;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use lockscreen\FilamentLockscreen\Lockscreen;
  use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
 use lockscreen\FilamentLockscreen\Http\Middleware\LockerTimer;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
 
 
//use TomatoPHP\FilamentTenancy\FilamentTenancyAppPlugin;

use Filament\Widgets\StatsOverview;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
             ->sidebarCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->breadcrumbs(true)
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make()
            )

            
           // ->plugin(new Lockscreen())

            ->plugins([
            //    FilamentAuthenticationLogPlugin::make(),
                FilamentEditProfilePlugin::make()
                ->shouldRegisterNavigation(false)
            ])
            ->plugins([
            //  FilamentAuthenticationLogPlugin::make()
                    // ->panelName('admin') // Optional: specify the panel name if needed
            ])
            //->plugin(\TomatoPHP\FilamentLogger\FilamentLoggerPlugin::make())
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->brandLogo(fn() => view('components.logo'))
            ->darkMode(false)
            // ->plugins([
            //     FilamentBackgroundsPlugin::make()->imageProvider(
            //         MyImages::make()
            //             ->directory('images/swisnl/filament-backgrounds/curated-by-swis'),
            //     ),
            // ])       


            
            // ->plugin(\TomatoPHP\FilamentPWA\FilamentPWAPlugin::make()
            // )  
            ->plugin(
               \TomatoPHP\FilamentSettingsHub\FilamentSettingsHubPlugin::make()
                   ->allowShield()
            )
            ->maxContentWidth(MaxWidth::Full)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([])
            ->widgets([
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                //SetTheme::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
            // LockerTimer::class 
 
             ])
            ->authMiddleware([
                Authenticate::class,
              // Locker::class, // <- Add this
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
   QuickCreatePlugin::make()
                    ->createAnother(false)
                    ->slideOver(),
            ])
            ->plugin(
               ThemesPlugin::make()
            );
    }
}