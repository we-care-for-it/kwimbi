<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Services\AddressService;


Route::get('/getAddress/{postalcode}', fn(string $postalcode): string => (new AddressService)->GetAddress($postalcode));

