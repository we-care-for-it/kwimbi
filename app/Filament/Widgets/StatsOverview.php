<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Elevator;
use App\Models\Project;
use App\Models\ObjectIncident;
use App\Models\ObjectLocation;

use App\Models\Customer;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Support\Enums\IconPosition;
use DB;
use App\Enums\InspectionStatus;
use App\Enums\ElevatorStatus;
use App\Models\ObjectInspection;
 
use App\Enums\ObjectStatus;
 
class StatsOverview extends BaseWidget
{

    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = '8';
    protected static bool $isLazy = false;
 

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {


        $incidentChart =   ObjectIncident::select(DB::raw('MONTH(report_date_time) as month'), DB::raw('count(*) as total'))
            ->whereYear('report_date_time', '2025')
            ->groupBy(DB::raw('MONTH(report_date_time)'))
            ->pluck('total', 'month')
            ->toArray();
    
        $incidentStillChart =   ObjectIncident::select(DB::raw('MONTH(report_date_time) as month'), DB::raw('count(*) as total'))
            ->whereYear('report_date_time', '2025')
            ->where('standing_still',1)
            ->groupBy(DB::raw('MONTH(report_date_time)'))
            ->pluck('total', 'month')
            ->toArray();

        $inspectionApporovedChart =   ObjectInspection::select(DB::raw('MONTH(executed_datetime) as month'), DB::raw('count(*) as total'))
            ->whereYear('executed_datetime', '2025')
            ->where('status_id', InspectionStatus::APPROVED)
            ->groupBy(DB::raw('MONTH(executed_datetime)'))
            ->pluck('total', 'month')
            ->toArray();
        
        $inspectionApporovedActionsChart =   ObjectInspection::select(DB::raw('MONTH(executed_datetime) as month'), DB::raw('count(*) as total'))
            ->whereYear('executed_datetime', '2025')
            ->where('status_id', InspectionStatus::APPROVED_ACTIONS)
            ->groupBy(DB::raw('MONTH(executed_datetime)'))
            ->pluck('total', 'month')
            ->toArray();
            
        $inspectionRejectedChart =   ObjectInspection::select(DB::raw('MONTH(executed_datetime) as month'), DB::raw('count(*) as total'))
            ->whereYear('executed_datetime', '2025')
            ->where('status_id', InspectionStatus::REJECTED)
            ->groupBy(DB::raw('MONTH(executed_datetime)'))
            ->pluck('total', 'month')
            ->toArray();

        return [
            Stat::make('Stilstaande objecten', Elevator::has("incident_stand_still")->latest()->count())
                ->chart($inspectionRejectedChart),
            Stat::make('Storingen', ObjectIncident::count())
                ->color('success')
                ->chart($incidentChart),
            Stat::make('Storingen stilstand',ObjectIncident::where('standing_still', 1)->count())
                ->chart($incidentStillChart)
                ->color('danger'),
            Stat::make('Objecten buitenbedrijf',Elevator::where('status_id', ElevatorStatus::TURNEDOFF)->count())
                ->color('danger'),
            Stat::make('Goedgekeurd',ObjectInspection::where('status_id', InspectionStatus::APPROVED)->count())
                ->chart($inspectionApporovedChart),
            Stat::make('Goedgekeurd met acties',ObjectInspection::where('status_id', InspectionStatus::APPROVED_ACTIONS)->count())
                ->chart($inspectionApporovedActionsChart)
                ->color('warning'),

        ];
    }
}
