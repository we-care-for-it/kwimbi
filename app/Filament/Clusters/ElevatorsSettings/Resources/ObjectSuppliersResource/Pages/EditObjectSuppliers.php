<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditObjectSuppliers extends EditRecord
{
    protected static string $resource = ObjectSuppliersResource::class;
    protected static ?string $title = 'Leverancier bewerken';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }

}