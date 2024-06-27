<?php

namespace App\Filament\Resources\ErrorsResource\Pages;

use App\Filament\Resources\ErrorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageErrors extends ManageRecords
{
    protected static string $resource = ErrorsResource::class;
    protected static ?string $navigationGroup = 'Basisgegevens';
    protected static ?string $title = 'Foutmeldingen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Toevoegen'),
        ];
    }
}
