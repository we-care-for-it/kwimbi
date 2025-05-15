<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;
    #[On('refreshForm')]
    public function refreshForm(): void
    {
        $this->fillForm();
    }
    protected function getHeaderActions():
    array {
        return [
            Action::make('back')

                ->label('Terug naar overzicht')
                ->link()
                ->url('/vehicles')
                ->color('gray'),
            Actions\EditAction::make()->icon('heroicon-m-pencil-square')
                ->slideOver(),
            Actions\DeleteAction::make()->icon('heroicon-m-trash'),
        ];
    }

}
