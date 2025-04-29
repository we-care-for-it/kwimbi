<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class TenantPanelProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Filament::serving(function () {
            Filament::registerRenderHook(
                'body.start',
                fn () => '<div class="tenant-header" style="padding: 1rem; background: #f0f0f0; text-align: center;">
                    Current Tenant: '.tenant('id').'
                </div>'
            );
        });
    }
}