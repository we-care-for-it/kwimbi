<?php

namespace App\Providers;

use App\Filament\Auth\Login;
use Awcodes\Curator\CuratorPlugin;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;

use Filament\Navigation\NavigationGroup;
use Awcodes\FilamentGravatar\GravatarPlugin;
use Awcodes\FilamentGravatar\GravatarProvider;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Pboivin\FilamentPeek\FilamentPeekPlugin;
use Filament\Support\Enums\MaxWidth;
use Awcodes\LightSwitch\LightSwitchPlugin;
use Kenepa\TranslationManager\TranslationManagerPlugin;

use lockscreen\FilamentLockscreen\Lockscreen;
use lockscreen\FilamentLockscreen\Http\Middleware\Locker;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
 

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
        ->breadcrumbs(false)
          //  ->sidebarCollapsibleOnDesktop()
         //  ->topNavigation()
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->profile()
            ->spa()
            ->databaseNotifications()
            ->maxContentWidth(MaxWidth::Full)
            ->plugin(new Lockscreen())  // <- Add this

            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make(),
                //FilamentTimesheetsPlugin::make(),
                FilamentSpatieLaravelBackupPlugin::make(),
            //    \Filament\SpatieLaravelTranslatablePlugin::make()->defaultLocales(['en', 'nl']),
              //  \TomatoPHP\FilamentMenus\FilamentMenusPlugin::make()
                )
            
            ->plugins([

                LightSwitchPlugin::make(),
                FilamentBackgroundsPlugin::make()
                
                ->imageProvider(
                    MyImages::make()
                        ->directory('images/swisnl/filament-backgrounds/elevators')
                ),
             //   TranslationManagerPlugin::make(),
                FilamentAuthenticationLogPlugin::make(),
          //  FilamentEnvEditorPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: false,
                        shouldRegisterNavigation: false,
                        hasAvatars: true
                    )
                    ->enableTwoFactorAuthentication(),
                    
                // CuratorPlugin::make()
                //     ->label('Media')
                //     ->pluralLabel('Media Library')
                //     ->navigationIcon('heroicon-o-photo')
                //     ->navigationGroup('Media')
                //     ->navigationCountBadge(),
                 FilamentExceptionsPlugin::make(),
             
                FilamentJobsMonitorPlugin::make()
                 ->navigationCountBadge(),
       
            //    FilamentPeekPlugin::make()
             //       ->disablePluginStyles(),

             
                GravatarPlugin::make(),
            ])
            ->defaultAvatarProvider(GravatarProvider::class)
            ->favicon(asset('/favicon-32x32.png'))
            ->brandLogo(fn () => view('components.logo'))
            ->navigationGroups([
                NavigationGroup::make()
                ->label("Objecten") 
       
                ->collapsible(false)
                ->extraSidebarAttributes(['class' => 'featured-sidebar-group']),
    //            ->extraTopbarAttributes(['class' => 'featured-topbar-group']),
          NavigationGroup::make()
                     ->label('Stamgegevens')
                     ->collapsible(true),
                NavigationGroup::make()
                    ->label('Beheer'),
          
                    NavigationGroup::make()
                ->label("Systeembeheer")
       
               

            ])
        
            ->colors([
                'primary' => Color::Blue,
            ])
            ->viteTheme('resources/css/admin.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
             ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
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
                  \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
                Locker::class, // <- Add this
              // <- Add this
            ]);
    }

    
}
