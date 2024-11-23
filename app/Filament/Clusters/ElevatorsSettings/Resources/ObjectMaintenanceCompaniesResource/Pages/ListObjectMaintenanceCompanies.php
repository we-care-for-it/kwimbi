<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectMaintenanceCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListObjectMaintenanceCompanies extends ListRecords
{
    protected static string $resource = ObjectMaintenanceCompaniesResource::class;
    protected static ?string $title = 'Object - Onderhoudspartijen';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.objects.index'))
            ->label('Terug naar objecten')
            ->link()
            ->color('gray'),
            \EightyNine\ExcelImport\ExcelImportAction::make()->label('Importeren')
                ->color("primary"),
 
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
