<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  });




  Route::get('object', \App\Http\Controllers\ApiObject::class)->middleware(['ensureTokenIsValid','apilogger']);

Route::middleware('apilogger')->post('endpoints/tuv', [App\Http\Controllers\Api\Endpoints\TuvController::class, 'handleWebhook']);
Route::middleware('apilogger')->get('endpoints/chex', [App\Http\Controllers\Api\Endpoints\ChexController::class, 'handleWebhook']);

