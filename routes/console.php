<?php

Schedule::command('app:import-chex')
    ->hourly()
    ->between('8:00', '20:00');
