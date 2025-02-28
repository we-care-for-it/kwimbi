<?php

Schedule::command('app:import-chex')->everyHourly()

    ->sendOutputTo('CHECK ERRRO.txt');
