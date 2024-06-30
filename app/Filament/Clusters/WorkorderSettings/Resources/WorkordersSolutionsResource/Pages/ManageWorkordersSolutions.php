<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources\WorkordersSolutionsResource\Pages;

use App\Filament\Clusters\WorkorderSettings\Resources\WorkordersSolutionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkordersSolutions extends ManageRecords
{
    protected static string $resource = WorkordersSolutionsResource::class;
    protected static ?string $title = 'Werkopdrachten - Oplossingen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
