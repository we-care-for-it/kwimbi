<?php

namespace App\Filament\Resources\ObjectLocationResource\Pages;

use App\Filament\Resources\ObjectLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
class ListObjectLocations extends ListRecords
{
    protected static string $resource = ObjectLocationResource::class;
    protected static ?string $title = 'Wijzig locatie';
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
