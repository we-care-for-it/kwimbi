<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\ProjectCalender;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Psr\SimpleCache\InvalidArgumentException;
use App\Services\TeamleaderService;

use App\Models\ExternalConnection;
use App\Models\Company;
use App\Models\Customer;

Route::get('/', function () {
    return redirect()->to('/admin');
});


Route::get('/teamleader.access', function () {
    $teamleader = new TeamleaderService(config('services.teamleader.client_id'), config('services.teamleader.client_secret'), config('services.teamleader.redirect_url'), config('services.teamleader.state'));
    header("Location: {$teamleader->redirectForAuthorizationUrl()}");
    exit;
});


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

    if (!cache('teamLeaderRefreshToken')) {
        ExternalConnection::updateOrCreate(
            ['name' => 'teamleader'],
            [
                'token1' => $teamleader->getAccessToken(),
                'token2' => $teamleader->getRefreshToken(),
                'token3' => $request->code,
                'token_expired' => $teamleader->getTokenExpiresAt(),
                'last_action_datetime' => date("Y-m-d H:i:s")
            ]
        );
    }
});


Route::get('/teamleader.dothing', function (Request $request) {
    $teamleader = new TeamleaderService(config('services.teamleader.client_id'), config('services.teamleader.client_secret'), config('services.teamleader.redirect_url'), config('services.teamleader.state'));

    $token_from_db = ExternalConnection::get()
        ->where('name', 'teamleader')
        ->first();
    $teamleader->setAccessToken($token_from_db->token1);
    $teamleader->setRefreshToken($token_from_db->token2);
    $teamleader->setAuthorizationCode($token_from_db->token3);
    $teamleader->setTokenExpiresAt($token_from_db->token_expired);

 
    $customers = $teamleader->get('companies.list');



    //Sync 
    if($customers){
        foreach($customers['data'] as $customer){
            Customer::updateOrCreate(
                ['api_uuid' => $customer['id']],
                [
                    'name'          => $customer['name'] ?? null,
                    'address'       => $customer['primary_address']['line_1'] ?? null,
                    'place'         => $customer['primary_address']['city'] ?? null,
                    'zipcode'       => $customer['primary_address']['postal_code'] ?? null,
                    'api_url'       => $customer['web_url'] ?? null,
                    'emailaddress'  => $customer['emails'][0]['email'] ?? null,
                    'phonenumber'   => $customer['emails'][0]['number'] ?? null,
                    'updated_at'    => date("Y-m-d H:i:s"),
                    'source'        => 'teamleader',
                ]
            );
        }
    }



    // you should always store your tokens at the end of a call
    $accessToken = $teamleader->getAccessToken();
    $refreshToken = $teamleader->getRefreshToken();
    $expiresAt = $teamleader->getTokenExpiresAt();


});

