<?php
namespace App\Filament\Resources\TimeTrackingResource\Pages;

use App\Filament\Resources\TimeTrackingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListTimeTrackings extends ListRecords
{
    protected static string $resource = TimeTrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Registratie toevoegen')

                ->modalWidth(MaxWidth::FourExtraLarge)
            //     ->modalHeading('Ruimte toevoegen')
            //    ->modalDescription('Vul een ruimte in om de gegevens op te halen')
                ->modalSubmitActionLabel('Opslaan')

                ->icon('heroicon-m-plus'),

        ];
    }

    protected function getHeaderWidgets(): array
    {

        return [
            // ObjectResource\Widgets\Monitoring::class,
            //     TimeTrackingResource\Widgets\StatsOverview::class,

        ];

    }

}
