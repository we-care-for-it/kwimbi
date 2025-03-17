<?php
namespace App\Filament\Resources\ObjectResource\Widgets;

use App\Models\ObjectMonitoring;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Model;

class FloorChart extends ChartWidget
{
    protected static ?string $heading          = 'Chart';
    protected int|string|array $columnSpan = '7';
    protected static ?string $maxHeight        = '100%';
    public ?Model $record                      = null;
    protected function getData(): array
    {
        $stopData = Trend::query(ObjectMonitoring::where('category', 'stop')->whereYear('created_at', date('Y'))
                ->where('external_object_id', $this->record->monitoring_object_id)->whereYear('created_at', date('Y')))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        $openData = Trend::query(ObjectMonitoring::where('category', 'doors')->where('value', 1)->whereYear('created_at', date('Y'))
                ->where('external_object_id', $this->record->monitoring_object_id)->whereYear('created_at', date('Y')))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        $closeData = Trend::query(ObjectMonitoring::where('category', 'doors')->where('value', 0)->whereYear('created_at', date('Y'))
                ->where('external_object_id', $this->record->monitoring_object_id)->whereYear('created_at', date('Y')))
            ->dateColumn('created_at')
            ->between(start: now()->startOfYear(), end: now()->endOfYear())
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label'           => 'Stops',
                    'backgroundColor' => 'rgb(194, 227, 243)',
                    'borderColor'     => 'rgb(172, 212, 233)',
                    'data'            => $stopData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
                [
                    'label'           => 'Geopend',
                    'backgroundColor' => 'rgb(249, 183, 196)',
                    'borderColor'     => 'rgb(249, 161, 178)',

                    'data'            => $openData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
                [
                    'label'           => 'Gesloten',
                    'backgroundColor' => 'rgb(133, 202, 143)',
                    'borderColor'     => 'rgb(133, 202, 143)',

                    'data'            => $closeData->map(fn(TrendValue $value) => round($value->aggregate)),
                ],
            ],
            'labels'   => $stopData->map(fn(TrendValue $value) => date('m', strtotime($value->date))),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
