<?php
namespace App\Filament\Resources\IncidentResource\Pages;

use App\Filament\Resources\IncidentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListIncidents extends ListRecords
{
    protected static string $resource = IncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Storing toevoegen')
                ->modalDescription('Voeg een nieuwe storing toe door de onderstaande gegevens zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')

                ->label('Storing toevoegen'),
        ];
    }

    public function getHeading(): string
    {
        return "Storingen - Overzicht";
    }
}
