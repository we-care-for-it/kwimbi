<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources\WorkordersErrorsResource\Pages;

use App\Filament\Clusters\WorkorderSettings\Resources\WorkordersErrorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkordersErrors extends ManageRecords
{
    protected static string $resource = WorkordersErrorsResource::class;

    protected static ?string $title = 'Werkopdrachten - Foutmeldingen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
