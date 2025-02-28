<?php

Schedule::command('app:import-chex')
    ->everyHourly()
    ->between('8:00', '20:00');
