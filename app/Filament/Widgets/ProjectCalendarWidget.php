<?php
 
namespace App\Filament\Widgets;
 
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
 
use App\Models\Project;

class ProjectCalendarWidget extends FullCalendarWidget
{
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        return Project::query()
            ->where('startdate', '>=', $fetchInfo['start'])
            ->where('enddate', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Project $event) => [
                    'title' => "#" . $event->id . " | " . $event->name . "-" . $event->customer->name,
                    'start' => $event->startdate,
                    'end' => $event->enddate,
                    'backgroundColor' => 'red',
                     'borderColor' => 'white',
                     'textColor' => 'white',
                     
                    
                    //'url' => EventResource::getUrl(name: 'view', parameters: ['record' => $event]),
                   
                ]
            )
            ->all();
    }
}


