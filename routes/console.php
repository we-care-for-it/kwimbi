<?php

use App\Services\GPSTrackingService;
use Illuminate\Support\Facades\Schedule;

//Schedule::command('app:team-leader-sync')->everyMinute()->appendOutputTo('teamleader.txt');

//Inspection Schedule
if (env('CHEX_TOKEN')) {
    Schedule::command('app:import-chex')->hourly();
}

//GPS Tracking Schedule
if (env('GPS_TRACKING_KEY')) {
    Schedule::call(function () {
        $objects = (new GPSTrackingService())->GetObjects();
    })->everyMinute('13:00');

    Schedule::call(function () {
        $objectsData = (new GPSTrackingService())->GetObjectsData();
    })->everyFiveMinutes();

}
