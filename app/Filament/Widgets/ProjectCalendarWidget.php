<?php
 
namespace App\Filament\Widgets;
 
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
 
use App\Models\Project;



class ProjectCalendarWidget extends FullCalendarWidget
{
    protected string $calendarView = 'listYear';
    public function fetchEvents(array $fetchInfo): array
    {
        return Project::query()
            ->where('startdate', '>=', $fetchInfo['start'])
            ->where('enddate', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Project $event) => [
                    'title'           => "#" . $event->id . " | " . $event->name . "-" . $event->customer->name,
                    'start'           => $event->startdate,
                    'end'             => $event->enddate,
                    'backgroundColor' => 'red',
                    'borderColor'     => 'white',
                    'textColor'       => 'white',    
                ]
            )
            ->all();
    }
}


