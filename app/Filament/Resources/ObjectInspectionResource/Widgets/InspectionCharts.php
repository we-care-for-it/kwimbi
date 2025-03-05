<?php
namespace App\Filament\Resources\ObjectInspectionResource\Widgets;

use App\Enums\InspectionStatus;
use App\Models\ObjectInspection;
use Filament\Facades\Filament;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InspectionCharts extends ChartWidget
{

    protected static ?string $maxHeight = '200px';
    protected static ?string $heading   = 'Verloop keuringen 2025';

    protected function getData(): array
    {

        $dataRejected = Trend::query(ObjectInspection::whereYear('executed_datetime', date('Y'))->where('company_id', Filament::getTenant()->id)->where('status_id', InspectionStatus::REJECTED))

            ->dateColumn('executed_datetime')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $dataApproved = Trend::query(ObjectInspection::whereYear('executed_datetime', date('Y'))->where('company_id', Filament::getTenant()->id)->where('status_id', InspectionStatus::APPROVED)
        )

            ->dateColumn('executed_datetime')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $dataApprovedActions = Trend::query(ObjectInspection::whereYear('executed_datetime', date('Y'))->where('company_id', Filament::getTenant()->id)->where('status_id', InspectionStatus::APPROVED_ACTIONS)
        )

            ->dateColumn('executed_datetime')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $dataApprovedRepeat = Trend::query(ObjectInspection::whereYear('executed_datetime', date('Y'))->where('company_id', Filament::getTenant()->id)->where('status_id', InspectionStatus::APPROVED_REPEAT)
        )

            ->dateColumn('executed_datetime')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $dataExpired = Trend::query(ObjectInspection::where('company_id', Filament::getTenant()->id)->where('deleted_at', null))

            ->dateColumn('end_date')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [

                [
                    'label'           => 'Afgekeurd',
                    'backgroundColor' => 'rgb(249, 183, 196)',
                    'borderColor'     => 'rgb(249, 161, 178)',
                    'data'            => $dataRejected->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label'           => ' Goedgekeurd',
                    'backgroundColor' => 'rgb(133, 202, 143)',
                    'borderColor'     => 'rgb(133, 202, 143)',
                    'data'            => $dataApproved->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label'           => 'Goedgekeurd (Herhaal punten)',
                    'backgroundColor' => 'rgb(255,251,235)',
                    'borderColor'     => 'rgb(251,237,212)',
                    'data'            => $dataApprovedActions->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label'           => 'Goed gekeurd (Met acties)',
                    'backgroundColor' => 'rgb(194, 227, 243)',
                    'borderColor'     => 'rgb(172, 212, 233)',
                    'data'            => $dataApprovedRepeat->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

                [
                    'label'           => 'Verlopen keuringen',

                    'backgroundColor' => 'rgb(249, 183, 196)',
                    'borderColor'     => 'rgb(249, 161, 178)',
                    'data'            => $dataExpired->map(fn(TrendValue $value) => round($value->aggregate)),
                ],

            ],
            'labels'   => $dataApproved->map(fn(TrendValue $value) => date('m', strtotime($value->date))),

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
                    'precision' => 1,
                ],
            ],

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
