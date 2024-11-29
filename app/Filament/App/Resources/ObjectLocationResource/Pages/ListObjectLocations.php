<?php

namespace App\Filament\App\Resources\ObjectLocationResource\Pages;

use App\Filament\App\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
class ListObjectLocations extends ListRecords
{
    protected static string $resource = ObjectLocationResource::class;
    protected static ?string $title = "locatie overzicht";
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::SevenExtraLarge)
                ->modalHeading('Locatie toevoegen')
                ->modalDescription('Voeg een nieuwe locatie toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->label('Locatie toevoegen'),
        ];
    }

    public function getHeading(): string
    {
      
        return "Locatie overzicht";
       
    }

}
