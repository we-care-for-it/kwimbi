<?php

use App\Http\Controllers\ObjectMonitoringController;
use App\Services\EBoekhouden;
use Illuminate\Support\Facades\Artisan;

Route::get('/monitoring/retrieveInfo', [ObjectMonitoringController::class, 'retrieveInfo']);

Route::get('/run-migration', function () {
    Artisan::call('migrate --force');
    return redirect('/');
});

Route::get('/test-service', function (EBoekhouden $service) {
    return $service->GetRelations();
});
