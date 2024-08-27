<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectInspectionCompanies extends ListRecords
{
    protected static string $resource = ObjectInspectionCompaniesResource::class;
    protected static ?string $title = 'Object - Keuringsinstanties';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
