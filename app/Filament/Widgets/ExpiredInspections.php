<?php
namespace App\Filament\Widgets;

use App\Models\ObjectInspection;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ExpiredInspections extends ChartWidget
{
    protected static ?string $heading = 'Verlopen keuringen 2025';

    protected static ?int $sort                = 2;
    protected int|string|array $columnSpan = '6';
    protected static ?string $maxHeight        = '100%';
    protected static bool $isLazy              = false;

    protected function getData(): array
    {

        $data = Trend::query(ObjectInspection::where('deleted_at', null))

            ->dateColumn('end_date')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $data_begin = Trend::query(ObjectInspection::where('deleted_at', null))

            ->dateColumn('executed_datetime')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        // $dataRejected = Trend::query(ObjectInspection::where('status_id', InspectionStatus::APPROVED)
        // )

        //     ->dateColumn('end_date')
        //     ->between(
        //         start: now()->startOfYear(),
        //         end: now()->endOfYear(),
        //     )
        //     ->perMonth()
        //     ->count();

        // $dataApprovedRepeat = Trend::query(ObjectInspection::where('status_id', InspectionStatus::APPROVED_REPEAT)
        // )

        //     ->dateColumn('end_date')
        //     ->between(
        //         start: now()->startOfYear(),
        //         end: now()->endOfYear(),
        //     )
        //     ->perMonth()
        //     ->count();

        return [
            'datasets' => [

                [
                    'label'           => 'Verlopen',
                    'backgroundColor' => 'rgb(249, 183, 196)',
                    'borderColor'     => 'rgb(249, 161, 178)',
                    'data'            => $data->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label'           => ' Keuringen',
                    'backgroundColor' => 'rgb(133, 202, 143)',
                    'borderColor'     => 'rgb(135, 184, 142)',
                    'data'            => $data_begin->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                // [
                //     'label'           => 'Met acties',
                //     'backgroundColor' => 'rgb(228, 204, 116)',
                //     'borderColor'     => 'rgb(224, 193, 79)',
                //     'data'            => $dataApprovedRepeat->map(fn(TrendValue $value) => round($value->aggregate)),
                // ],

            ],
            'labels'   => $data->map(fn(TrendValue $value) => date('m', strtotime($value->date))),

        ];
    }

    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'Today',
    //         'week'  => 'Last week',
    //         'month' => 'Last month',
    //         'year'  => 'This year',
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
            'scale'   => [

                'ticks' => [
                    'precision' => 0,
                ],
            ],

        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
