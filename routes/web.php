<?php

// Route::get('/', function () {
//     return redirect()->to('/app');
// });
Route::get('/404', function () {
    return response()->view('errors.404'); // This will load the 404 error view
});

Route::get('/500', function () {
    return response()->view('errors.500'); // This will load the 500 error view
});