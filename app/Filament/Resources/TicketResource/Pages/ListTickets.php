<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all'       => Tab::make(),
            'incidents' => Tab::make()
                ->label('Incidenten')
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 1))
                ->badge(Ticket::query()->where('type_id', 1)->count()),
            'changes'   => Tab::make()
                ->label('Aanpassingen')
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 2))
                ->badge(Ticket::query()->where('type_id', 2)->count()),
        ];
    }
}
