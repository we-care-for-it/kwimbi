<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;


Route::get('/', Home::class)->name('home');
 



return Redirect::to('http://heera.it');

