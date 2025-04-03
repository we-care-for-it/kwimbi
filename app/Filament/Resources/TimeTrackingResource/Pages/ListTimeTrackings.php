<?php
namespace App\Filament\Resources\TimeTrackingResource\Pages;

use App\Filament\Resources\TimeTrackingResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListTimeTrackings extends ListRecords
{
    protected static string $resource = TimeTrackingResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Registratie toevoegen')
                ->modalDescription('Voeg een nieuwe registratie toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Registratie toevoegen'),
        ];
    }
    public function getHeading(): string
    {
        return "Tijdregistratie - Overzicht";
    }

    protected function getHeaderWidgets(): array
    {

        return [
            // ObjectResource\Widgets\Monitoring::class,
            //     TimeTrackingResource\Widgets\StatsOverview::class,

        ];

    }
}
