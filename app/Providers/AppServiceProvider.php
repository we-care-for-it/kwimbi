<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       // $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
       // $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Schema::defaultStringLength(191);
     //   $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
     //   $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
        FilamentAsset::register([
            Css::make('custom', __DIR__ . '/../../resources/css/custom.css'),
        ]);

     
    }
}
