<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;


class TaskCountWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $userId = auth()->id();

        return [
            Card::make('My Tasks', Task::where('employee_id', $userId)->count())
                ->description('Total tasks assigned to you')
                ->color('primary'),

            Card::make('Pending Tasks', Task::where('employee_id', $userId)->where('status', 'pending')->count())
                ->description('Tasks waiting for completion')
                ->color('warning'),

            Card::make('Completed Tasks', Task::where('employee_id', $userId)->where('status', 'completed')->count())
                ->description('Tasks you have finished')
                ->color('success'),
        ];
    }
}