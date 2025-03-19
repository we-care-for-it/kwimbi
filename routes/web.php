<?php

use App\Http\Controllers\ObjectMonitoringController;

Route::get('/monitoring/retrieveInfo', [ObjectMonitoringController::class, 'retrieveInfo']);
