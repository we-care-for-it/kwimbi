<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\ActionGroup;
use Livewire\Attributes\On;

class ViewTicket extends ViewRecord
{

    #[On('refreshForm')]
    public function refreshForm(): void
    {
        $this->fillForm();
    }

    protected static string $resource = TicketResource::class;

    protected $listeners = ["refresh" => '$refresh'];

    protected function getHeaderActions():
    array {
        return [
            Action::make('back')
                ->label('Terug naar overzicht')
                ->link()
                ->url(url()->previous())
                ->color('gray'),

            Actions\EditAction::make()
                ->slideOver()

                ->icon('heroicon-m-pencil-square'),

            ActionGroup::make([
                Actions\DeleteAction::make('Verwijderen'),
            ]),

        ];
    }

}
