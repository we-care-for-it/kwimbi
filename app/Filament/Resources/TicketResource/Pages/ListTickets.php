<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    public function getTabs(): array
    {
        return [
            'alle'      => Tab::make(),
            'incidents' => Tab::make()
                ->label('Incidenten')
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 1))
                ->badge(Ticket::query()->where('type_id', 1)->count()),
            'changes'   => Tab::make()
                ->label('Aanpassingen')
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 2))
                ->badge(Ticket::query()->where('type_id', 2)->count()),
            'Hoog'      => Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 1))
                ->badgeColor('danger')
                ->badge(Ticket::query()->where('prio', 2)->count()),
            'Gemiddeld' => Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 2))
                ->badgeColor('warning')
                ->badge(Ticket::query()->where('prio', 1)->count()),
            'Laag'      => Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 3))
                ->badgeColor('success')
                ->badge(Ticket::query()->where('prio', 3)->count()),

        ];
    }
}
