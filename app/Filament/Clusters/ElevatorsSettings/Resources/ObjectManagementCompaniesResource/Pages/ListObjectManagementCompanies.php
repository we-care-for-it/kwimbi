<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectManagementCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
class ListObjectManagementCompanies extends ListRecords
{
    protected static string $resource = ObjectManagementCompaniesResource::class;
    protected static ?string $title = 'Object - Beheerders';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.objects.index'))
            ->label('Terug naar objecten') 
            ->link()
            ->color('gray'),
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
