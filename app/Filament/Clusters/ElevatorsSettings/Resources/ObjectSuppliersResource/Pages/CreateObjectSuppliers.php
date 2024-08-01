<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateObjectSuppliers extends CreateRecord
{
    protected static string $resource = ObjectSuppliersResource::class;
    protected static ?string $title = 'Leverancier toevoegen';
  

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index')->label('Leverancier toevoegen');
    }

}
