<?php

namespace App\Filament\Resources\ObjectResource\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class FloorChart extends ChartWidget
{
    protected static ?string $heading          = 'Chart';
    protected int|string|array $columnSpan = '7';
    protected static ?string $maxHeight        = '100%';
    public ?Model $record                      = null;
    

    protected function getData(): array
    {
        $stopData  = Trend::where('external_object_id', $this->record->monitoring_object_id)
            ->whereYear('created_at', date('Y'))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        $openData = Trend::where('external_object_id', $this->record->monitoring_object_id)
            ->whereYear('created_at', date('Y'))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        $closeData = Trend::where('external_object_id', $this->record->monitoring_object_id)
            ->whereYear('created_at', date('Y'))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label'           => 'Stop',
                    'backgroundColor' => 'rgb(0, 0, 255)',  // Blue
                    'borderColor'     => 'rgb(0, 0, 200)',
                    'data'            => $stopData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
                [
                    'label'           => 'Open',
                    'backgroundColor' => 'rgb(255, 0, 0)',  // Red
                    'borderColor'     => 'rgb(200, 0, 0)',
                    'data'            => $openData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
                [
                    'label'           => 'Close',
                    'backgroundColor' => 'rgb(0, 128, 0)',  // Green
                    'borderColor'     => 'rgb(0, 100, 0)',
                    'data'            => $closeData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
            ],
            'labels' => $stopData->map(fn(TrendValue $value) => date('m', strtotime($value->date))),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
