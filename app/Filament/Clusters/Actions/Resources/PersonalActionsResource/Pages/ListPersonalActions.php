<?php
namespace App\Filament\Clusters\Actions\Resources\PersonalActionsResource\Pages;

use App\Filament\Clusters\Actions\Resources\PersonalActionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonalActions extends ListRecords
{
    protected static string $resource = PersonalActionsResource::class;
    protected static ?string $title   = 'Mijn acties';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->label('Actie toevoegen')
                ->modalHeading('Actie toevoegen')
                ->modalDescription('Voor een actie toe voor je zelf of een andere medewerker')
                ->modalSubmitActionLabel('Opslaan')
            ,
        ];
    }
}
