<?php

namespace App\Filament\Resources\SpaceResource\Pages;

use App\Filament\Resources\SpaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListSpaces extends ListRecords
{
    protected static string $resource = SpaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ruimte toevoegen')
                ->slideOver()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Ruimte toevoegen')
                ->modalDescription('Vul een ruimte in om de gegevens op te halen')
                ->modalSubmitActionLabel('Opslaan')
                ->modalIcon('heroicon-o-plus')
                ->icon('heroicon-m-plus')
                ->slideOver()
                ->label('Ruimte toevoegen'),
        ];
    }

    public function getHeading(): string
    {
        return "Ruimte - Overzicht";
    }
}
