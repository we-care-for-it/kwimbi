<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?string $heading = 'Porjecten';
    protected static ?int $sort = 1;
 protected function getStats(): array
    {
        return [
        Stat::make('Storingen', '192.1k')
            ->description('incidenten')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),

        Stat::make('Projecten', '23')
            ->description('7% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger') ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        Stat::make('Stilstaand  objecten', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Afgekeurd  ', '3:12')

                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger'),


        ];
    }
}
