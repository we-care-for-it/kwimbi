<?php

Schedule::command('app:import-chex')
    ->hourly()
    ->between('8:00', '20:00');

Schedule::command('app:m-q-t-t-modusystem')
    ->between('6:00', '23:59')
    ->everyFiveMinutes();
