<?php
namespace App\Filament\Resources\ObjectInspectionResource\Pages;

use App\Filament\Resources\ObjectInspectionResource;
use Filament\Resources\Pages\ListRecords;

class ListObjectInspections extends ListRecords
{
    protected static string $resource = ObjectInspectionResource::class;
    protected static ?string $title   = 'Overzicht alle keuringen';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getSubheading(): ?string
    {

        return "Een overzicht van alle actuele keuringen ";

    }

}
