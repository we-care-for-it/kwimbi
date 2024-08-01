<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjectSuppliers extends ListRecords
{
    protected static string $resource = ObjectSuppliersResource::class;
    protected static ?string $title = 'Object - Leveranciers';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Leverancier toevoegen'),
        ];
    }
}
