<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTools extends EditRecord
{
    protected static string $resource = ToolsResource::class;
    protected static ?string $title = 'Gereedschap - Wijzigen';
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }


    public function getRelationManagers(): array
    {
        return [];
    }


    public function getHeading(): string
    {
        return 'Wijzig: ' . $this->getRecord()->name;
    }
}
