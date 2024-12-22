<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\ProjectCalender;


Route::get('/', function () {
    return redirect()->to('/admin');
});




Route::get('/project-calender', ProjectCalender::class)->name('project-calender');

//             ->query(
// dd(
//                 Elevator::whereHas('inspections', fn($query) =>
//         $query->whereColumn('created_at', fn($subquery) =>
//             $subquery->selectRaw('MAX(created_at)')
//                 ->from('inspections')
//                 ->whereColumn('object_id', 'object.id')
//         )->where('status_id', '3')->get())
//     )
