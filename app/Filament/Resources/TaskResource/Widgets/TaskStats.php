<?php

namespace App\Filament\Resources\TaskResource\Widgets;

use App\Models\Task;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TaskStats extends BaseWidget
{
    public $activeFilter = 'all'; // Livewire property om actieve filter bij te houden

   protected function getColumns(): int
    {
        return 4;
    }

    protected function getCards(): array
    {
        $userId = auth()->id();
        $today = Carbon::today();

        $tasks = Task::withTrashed()
            ->where('employee_id', $userId)
            ->get();

        $total = $tasks->count();
        $completed = $tasks->whereNotNull('deleted_at')->count();
        $todayTasks = $tasks->whereNull('deleted_at')
            ->where('begin_date', '<=', $today)
            ->count();
        $upcoming = $tasks->whereNull('deleted_at')
            ->where('begin_date', '>', $today)
            ->count();

        // Helper functie voor actieve klasse
        $getCardClass = fn($type) => 'bg-white shadow-lg rounded-xl text-gray-800 cursor-pointer' . 
            ($this->activeFilter === $type ? ' border-2 border-primary' : '');

        return [
            Card::make('Totaal Taken', $total)
                ->description('Alle taken die aan jou zijn toegewezen')
                ->descriptionIcon('heroicon-m-clipboard-document-list'),
         

            Card::make('Voltooide Taken', $completed)
                ->description('Afgeronde en gearchiveerde taken')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->extraAttributes([
                    'class' => $getCardClass('completed'),
                    'wire:click' => "\$dispatch('filter-tasks', { type: 'completed' })",
                ]),

            Card::make('Vandaag Te Doen', $todayTasks)
                ->color('primary')
                ->description('Taken die vandaag of eerder gestart moesten zijn')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->extraAttributes([
                    'class' => $getCardClass('today'),
              'wire:click' => "\$dispatch('filter-tasks', 'today')",
                ]),

            Card::make('Komende Taken', $upcoming)
                ->color('secondary')
                ->description('Taken die later starten')
                ->descriptionIcon('heroicon-m-clock')
                ->extraAttributes([
                    'class' => $getCardClass('upcoming'),
                    'wire:click' => "\$dispatch('filter-tasks', { type: 'upcoming' })",
                ]),
        ];
    }
}



 