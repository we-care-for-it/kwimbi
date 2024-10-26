<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\ProjectCalender;


Route::get('/', function () {
    return redirect()->to('/admin');
});




Route::get('/project-calender', ProjectCalender::class)->name('project-calender');

