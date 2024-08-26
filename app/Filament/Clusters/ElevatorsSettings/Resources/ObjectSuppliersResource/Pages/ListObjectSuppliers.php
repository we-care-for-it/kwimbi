<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
class ListObjectSuppliers extends ListRecords
{
    protected static string $resource = ObjectSuppliersResource::class;
    protected static ?string $title = 'Object - Leveranciers';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.elevators.index'))
            ->label('Terug naar objecten') 
            ->link()
            ->color('gray'),
            Actions\CreateAction::make()->label('Leverancier toevoegen'),
        ];
    }
}