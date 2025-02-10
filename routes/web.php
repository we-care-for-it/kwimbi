<?php

use App\Services\GPSTrackingService;
use App\Services\TeamleaderService;
use App\Services\TomTomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/app');
});

Route::get('update/elevators', [App\Http\Controllers\UpdateElevatorChecksConroller::class, 'update']);

Route::get('/teamleader.access', function () {
    $teamleader = new TeamleaderService(config('services.teamleader.client_id'), config('services.teamleader.client_secret'), config('services.teamleader.redirect_url'), config('services.teamleader.state'));
    //header("Location: {$teamleader->redirectForAuthorizationUrl()));
    exit;
});

Route::get('/tomtom', function () {
    $test = (new TomTomService())->GetAddressByCoordinates('4.314215', '51.978427');
    dd($test);
    exit;
});
Route::get('/gpstest2', function () {

    $test = (new GPSTrackingService())->GetObjectsData();
    dd($test);
    //header("Location: {$teamleader->redirectForAuthorizationUrl()));
    exit;
});

Route::get('update/elevators', [App\Http\Controllers\UpdateElevatorChecksConroller::class, 'update']);

Route::get('/teamleader.callback', function (Request $request) {

    $teamleader = new TeamleaderService(config('services.teamleader.client_id'), config('services.teamleader.client_secret'), config('services.teamleader.redirect_url'), config('services.teamleader.state'));

    if ($request->error) {
        dd($request->error);
    }

    if ($request->state != $teamleader->getState()) {
        dd('De state is niet het zelfde');
    }

    $teamleader->setAuthorizationCode($request->code);
    $teamleader->connect();

    if (! cache('teamLeaderRefreshToken')) {
        cache()->set('teamLeaderAccessToken', $teamleader->getAccessToken(), 500);
        cache()->set('teamLeaderRefreshToken', $teamleader->getRefreshToken(), 500);
        cache()->set('teamLeaderExpiresAt ', $teamleader->getTokenExpiresAt(), 500);
        cache()->set('teamLeaderCode', $request->code, 500);

    }
});

Route::get('/teamleader.dothing', function (Request $request) {
    $teamleader = new TeamleaderService(config('services.teamleader.client_id'), config('services.teamleader.client_secret'), config('services.teamleader.redirect_url'), config('services.teamleader.state'));
    $teamleader->setAuthorizationCode(cache()->get('teamLeaderCode'));

    $teamleader->setAccessToken(cache()->get('teamLeaderAccessToken'));
    $teamleader->setRefreshToken(cache()->get('teamLeaderRefreshToken'));
    $teamleader->setTokenExpiresAt(cache()->get('teamLeaderExpiresAt'));
    $teamleader->shouldRefreshToken();
    dd($teamleader->get('contacts.list'));
});
