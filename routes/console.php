<?php

Schedule::command('app:import-chex')
    ->hourly()
    ->between('8:00', '20:00');

if (config("services.modusystem.username")) {
    Schedule::command('app:m-q-t-t-modusystem')
        ->appendOutputTo('schedule.log')
        ->everySecond();
}

// ->between('6:00', '23:59')
// ->everyFiveMinutes();
