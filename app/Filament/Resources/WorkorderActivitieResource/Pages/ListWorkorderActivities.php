<?php
namespace App\Filament\Resources\WorkorderActivitieResource\Pages;

use App\Filament\Resources\WorkorderActivitieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkorderActivities extends ListRecords
{
    protected static string $resource = WorkorderActivitieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen')
                ->modalHeading('Uurtype aanmaken')->slideOver(),
        ];
    }
}
