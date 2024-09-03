<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
class ListObjectInspectionCompanies extends ListRecords
{
    protected static string $resource = ObjectInspectionCompaniesResource::class;
    protected static ?string $title = 'Object - Keuringsinstanties';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.elevators.index'))
            ->label('Terug naar objecten') 
            ->link()
            ->color('gray'),
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
