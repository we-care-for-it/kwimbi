<?php

namespace App\Filament\Resources\TaskResource\Widgets;
use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Stats extends BaseWidget
{

 

    protected function getStats(): array
    {

        $userId = auth()->id();

        return [
           Card::make('Vandaag te doen', Task::where('employee_id', $userId)->count())
                ->description('Total tasks assigned to you')
                ->whereDate('begin_date', Carbon::today())
                ->color('primary'),

            Card::make('Pending Tasks', Task::where('employee_id', $userId)->where('type_id', '1')->count())
                ->description('Tasks waiting for completion')
                ->color('warning'),

            Card::make('Completed Tasks', Task::where('employee_id', $userId)->where('type_id', '2')->count())
                ->description('Tasks you have finished')
                ->color('success'),      
             Card::make('Completed Tasks', Task::where('employee_id', $userId)->where('type_id', '3')->count())
                ->description('Tasks you have finished')
                ->color('success'),

             Card::make('Completed Tasks', Task::where('employee_id', $userId)->where('type_id', '3')->count())
                  ->description('3% increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up') 
                ->color('success')
                
          
                


                
                ];
                
    }
}
