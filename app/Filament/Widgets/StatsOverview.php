<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Elevator;
use App\Models\Project;
use App\Models\ObjectIncident;
use App\Models\ObjectLocation;
use App\Models\Customer;
use Filament\Support\Enums\IconPosition;
class StatsOverview extends BaseWidget
{


    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = '12';
    protected static bool $isLazy = false;
    protected function getColumns(): int
    {
        return 4;
    }
    protected function getStats(): array
    {





        return [

            Stat::make('Stilstaande objecten', Elevator::has("incident_stand_still")->latest()->count()),
            Stat::make('Locaties', ObjectLocation::count()),
          //  Stat::make('Projecten', Project::count()),
           // Stat::make('Storingen',ObjectIncident::count()),
            Stat::make('Projecten', Project::count()),
            Stat::make('Storingen',ObjectIncident::count()),
 
 
 
 
            // Stat::make('Goedgekeurd', '192.1k')
            //     ->description('Verloop afgelopen jaar')
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
//                ->chart([7, 2, 10, 3, 15, 4, 17])

                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                // ->chart([7, 2, 90, 50, 15, 4, 50])
                // ->color('warning'),
            // ...


            // Stat::make('Goedgekeurd met acties', '192.1k')
            //     ->description('Verloop afgelopen jaar')
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
//                ->chart([7, 2, 10, 3, 15, 4, 17])

                // ->descriptionIcon('heroicon-m-arrow-trending-up')
                // ->chart([7, 2, 10, 3, 15, 4, 17])
                // ->color('primary'),
            // ...


            // Stat::make('Afgekeurd', '192.1k')
            //     ->description('Afgekeurd verloop')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->chart([7, 2, 10, 3, 15, 4, 17])
            //     ->color('danger'),
//                ->descriptionIcon('heroicon-m-arrow-trending-up')
//                ->chart([7, 2, 10, 3, 15, 4, 17])
//                ->color('danger'),
            // ...





         

        ];
            // ...



    }
}
