<?php

namespace App\Filament\Resources\WorkTypesResource\Pages;

use App\Filament\Resources\WorkTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkTypes extends ManageRecords
{
    protected static string $resource = WorkTypesResource::class;
    protected static ?string $title = 'Werkomschrijvingen';

  
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
