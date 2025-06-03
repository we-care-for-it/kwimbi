<?php
namespace App\Filament\Resources\TicketStatusResource\Pages;

use App\Filament\Resources\TicketStatusResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListTicketStatuses extends ListRecords
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Terug naar instellingen')
                ->link()
                ->url(url()->previous())
                ->color('gray'),

            Actions\CreateAction::make()
                ->label('Toevoegen')
                ->modalWidth(MaxWidth::ExtraLarge)
                ->modalHeading('Ticket type toevoegen'),

        ];
    }

    public function getHeading(): string
    {
        return "Ticket Statuses - Overzicht";
    }
}
