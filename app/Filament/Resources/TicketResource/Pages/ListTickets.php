<?php
namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\ticketStatus;
use Asmit\ResizedColumn\HasResizableColumn;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;
    use HasResizableColumn;
    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    public function getTabs(): array
    {

        $ticketStatuses = ticketStatus::whereIsActive(1)->orderBy('sort', 'asc')->get();

        foreach ($ticketStatuses as $ticketStatus) {
            $tabs[$ticketStatus->name] = Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('status_id', $ticketStatus->id))
                ->badge(Ticket::query()->where('status_id', $ticketStatus->id)->count());
        }

        $tabs['Hoog'] = Tab::make()
            ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 1))
            ->badgeColor('danger')
            ->badge(Ticket::query()->where('prio', 1)->count());

        $tabs['Gemiddeld'] = Tab::make()
            ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 21))
            ->badgeColor('warning')
            ->badge(Ticket::query()->where('prio', 2)->count());

        $tabs['Laag'] = Tab::make()
            ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 3))
            ->badgeColor('success')
            ->badge(Ticket::query()->where('prio', 3)->count());

        return $tabs;
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'alle'      => Tab::make(),
    //         'incidents' => Tab::make()
    //             ->label('Incidenten')
    //             ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 1))
    //             ->badge(Ticket::query()->where('type_id', 1)->count()),
    //         'changes'   => Tab::make()
    //             ->label('Aanpassingen')
    //             ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', 2))
    //             ->badge(Ticket::query()->where('type_id', 2)->count()),
    //         'Hoog'      => Tab::make()
    //             ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 1))
    //             ->badgeColor('danger')
    //             ->badge(Ticket::query()->where('prio', 1)->count()),
    //         'Gemiddeld' => Tab::make()
    //             ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 2))
    //             ->badgeColor('warning')
    //             ->badge(Ticket::query()->where('prio', 2)->count()),
    //         'Laag'      => Tab::make()
    //             ->ModifyQueryUsing(fn(Builder $query) => $query->where('prio', 3))
    //             ->badgeColor('success')
    //             ->badge(Ticket::query()->where('prio', 3)->count()),

    //     ];
    // }
}
