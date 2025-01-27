<?php
namespace App\Filament\Resources\ActionResource\Pages;

use App\Filament\Resources\ActionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActions extends ListRecords
{
    protected static string $resource = ActionResource::class;
    protected static ?string $title   = 'Alle acties';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Actie toevoegen')
                ->slideOver()
                ->modalHeading('Actie toevoegen')
                ->modalDescription('Voor een actie toe voor je zelf of een andere medewerker')
                ->modalSubmitActionLabel('Opslaan')
            ,
        ];
    }
}
