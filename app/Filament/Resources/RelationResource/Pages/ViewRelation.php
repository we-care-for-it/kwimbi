<?php

namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRelation extends ViewRecord
{
    protected static string $resource = RelationResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Wijzigen')->slideOver() 
        ];
    }
}
