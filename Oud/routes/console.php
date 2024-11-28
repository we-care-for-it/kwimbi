<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\importChex;

Schedule::command('app:import-chex')->everyMinute()->appendOutputTo('checkkk.txt');

