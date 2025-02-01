<?php
namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Voertuig toevoegen')
                ->slideOver()
                ->modalHeading('Voortuig toevoegen')
                ->modalDescription('Vul een kenteken in om de gegevens op te halen')
                ->modalSubmitActionLabel('Opslaan'),
        ];
    }
}
