<?php
namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('viewApiDocs', function (User $user) {
            return in_array($user->email, ['superadmin@ltssoftware.nl']);
        });

        Filament::registerNavigationGroups([
            'Objecten',
            'Blog',
            'Settings',
        ]);

        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/tenant.css'),
        ]);

        FilamentColor::register([
            'primary' => Color::hex('#ff0000'),
        ]);
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                // UserMenuItem::make()
                //     ->label('Instellingen')
                //     ->url(route('filament.admin.general'))
                //     ->icon('heroicon-s-cog'),
                // UserMenuItem::make()
                //     ->label('Logboek')
                //     ->url(route('filament.admin.logs'))
                //     ->icon('heroicon-m-clipboard-document-list'),
                UserMenuItem::make()
                    ->label('Mijn profiel')
                    ->url('/admin/edit-profile')
                    ->icon('heroicon-o-user'),

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
