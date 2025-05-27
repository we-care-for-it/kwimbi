<?php
namespace App\Filament\Resources\TicketStatusResource\Pages;

use App\Filament\Resources\TicketStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListTicketStatuses extends ListRecords
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Relatie Type toevoegen')

                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Ticket type toevoegen')
                ->modalDescription('Voeg een nieuw ticket type toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->modalSubmitActionLabel('Opslaan')
                ->modalIcon('heroicon-o-plus')
                ->icon('heroicon-m-plus')

                ->label('Object Type toevoegen'),
        ];
    }

    public function getHeading(): string
    {
        return "Ticket Types - Overzicht";
    }
}
