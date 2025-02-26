<?php

Schedule::command('app:import-chex')->hourly()

    ->sendOutputTo('CHECK ERRRO.txt');
