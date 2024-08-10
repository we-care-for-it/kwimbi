<?php

namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTools extends ViewRecord
{
    protected static string $resource = ToolsResource::class;

    protected function getHeaderActions():
    array
    {
        return [
            Actions\EditAction::make()->icon('heroicon-m-pencil-square'),
            Actions\DeleteAction::make()->icon('heroicon-m-trash')
        ];
    }
    public function getHeading(): string
    {
        return 'Wijzig: ' . $this->getRecord()->name;
    }
    public function getTitle(): string
    {
        return 'Wijzig: ' . $this->getRecord()->name;
    }





}
