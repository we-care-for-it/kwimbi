<?php

namespace App\Filament\Resources\InspectionCompaniesResource\Pages;

use App\Filament\Resources\InspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInspectionCompanies extends ListRecords
{
    protected static string $resource = InspectionCompaniesResource::class;
    protected static ?string $title = 'Keuringinstanties';
    protected ?string $subheading = 'Een overzicht van alle keuringsinstanties binnen liftindex';
 

 

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
