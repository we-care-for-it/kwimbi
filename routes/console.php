<?php
use App\Services\GPSTrackingService;
//Inspections - Check
Schedule::command('app:import-chex')
    ->appendOutputTo('checx.log')
    ->everyMinute()
    ->between('8:00', '20:00');

//Monitoring - Modusystem
if (config("services.modusystem.username")) {
    Schedule::command('app:m-q-t-t-modusystem')
        ->between('12:00', '23:59')
        ->everySecond();
}

//GPS - LoveTracking
if (env('GPS_TRACKING_KEY')) {
    Schedule::call(function () {
        $objects = (new GPSTrackingService())->GetObjects();
    })
    // ->between('6:00', '23:59')
        ->everyMinute()
        ->appendOutputTo("tacking.text");

    Schedule::call(function () {
        $objects = (new GPSTrackingService())->GetObjectsData();
    })
    // ->between('6:00', '23:59')
        ->everyMinute()
        ->appendOutputTo("tacking.text");
}
