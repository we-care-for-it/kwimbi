<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use Filament\Pages\Actions\EditAction;
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
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->slideOver(),
        ];
    }

}
