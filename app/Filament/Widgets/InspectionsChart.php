<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\ObjectInspection;
use App\Enums\InspectionStatus;

class InspectionsChart extends ChartWidget
{
    protected static ?string $heading = 'Keuringen 2025';
 
        protected static ?int $sort =1;
    protected int | string | array $columnSpan = '4';
    protected static ?string $maxHeight = '160px';
    protected static bool $isLazy = false;

    protected function getData(): array
    {


        $data = Trend::query(ObjectInspection::where('status_id', InspectionStatus::REJECTED))
        
 
        ->dateColumn('executed_datetime')
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

        $dataRejected = Trend::query(ObjectInspection::where('status_id', InspectionStatus::APPROVED)
        )

        ->dateColumn('executed_datetime')
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

        $dataApprovedRepeat = Trend::query(ObjectInspection::where('status_id', InspectionStatus::APPROVED_REPEAT)
        )

        ->dateColumn('executed_datetime')
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();


 

        
        return [
            'datasets' => [
         

                [
                    'label' => 'Afgekeurd',
                    'backgroundColor'=> 'rgb(249, 183, 196)',
                    'borderColor'=>  'rgb(249, 161, 178)',    
                    'data' => $dataRejected->map(fn (TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label' =>' Goedgekeurd',
                    'backgroundColor'=> 'rgb(133, 202, 143)',
                    'borderColor'=> 'rgb(135, 184, 142)',
                    'data' => $data->map(fn (TrendValue $value) => round($value->aggregate)),
                ],
                

                // [
                //     'label' => 'Met acties',
                //     'backgroundColor'=> 'rgb(228, 204, 116)',
                //     'borderColor'=> 'rgb(224, 193, 79)',    
                //     'data' => $dataApprovedRepeat->map(fn (TrendValue $value) => round($value->aggregate)),
                // ],
 
            ],
            'labels' => $data->map(fn (TrendValue $value) => date('m', strtotime($value->date)))
 
        ];
    }


//     protected function getFilters(): ?array
// {
//     return [
//         'today' => 'Today',
//         'week' => 'Last week',
//         'month' => 'Last month',
//         'year' => 'This year',
//     ];
// }


protected function getOptions(): array
{
    return [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
        'scale' =>[

            'ticks' => [
                'precision' => 0,
            ],
        ]  
        



    ];
}


    protected function getType(): string
    {
        return 'line';
    }
}



 