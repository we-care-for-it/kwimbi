<?php
namespace App\Providers\Filament;
use App\Models\Company;

use App\Filament\Pages\Tenancy\RegisterCompany;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
 use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Support\Enums\MaxWidth;
class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
       
->darkMode(false)
->default()
            ->id('app')
            ->path('')
   	    ->tenant(Company::class)
            ->maxContentWidth(MaxWidth::Full)
  ->sidebarCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->breadcrumbs(true)
->plugins([
              
                FilamentSocialitePlugin::make()
                    ->providers([
                        Provider::make('azure')
     ->icon('fab-microsoft')
  ->color(Color::hex('#5E5E5E'))
       ->outlined(false)            
                    ])->slug('app')

   
                    ->createUserUsing(fn (string $provider, User $oauthUser, FilamentSocialitePlugin $plugin) => UserModel::create([
                        'name' => $oauthUser->user['givenName'] . " " . $oauthUser->user['surname'],
 
                        'email' => $oauthUser->getEmail(),
                    ]))

                    ->registration(false)            ])



    ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->login()
     ->brandLogo(fn() => view('components.logo'))
            ->colors([
                'primary' => Color::Amber,
            ])      ->plugin(
            \Hasnayeen\Themes\ThemesPlugin::make()
        )    ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])   ->tenantMiddleware([
                      \Hasnayeen\Themes\Http\Middleware\SetTheme::class
        ], isPersistent: true)
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
