<?php
namespace App\Services;

use App\Models\gpsObject;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

final class GPSTrackingService
{
    private PendingRequest $client;
    public function __construct()
    {

        $this->client = Http::baseUrl(config('services.cargps.url'));
    }

    protected function token(): string
    {
        return config('services.cargps.token');
    }

    protected function call(string $method, string $url, array $payload): Response
    {
        $this->client
            ->withoutVerifying()
            ->withOptions(["verify" => false]);

        $response = $this->client->{$method}($url, $payload);
        return $response;
    }

    public function GetObjects(): string
    {

        $request = $this->call(method: 'get', url: '1.php', payload: [
            'key' => $this->token(),
            'api' => "pl",
            'ver' => "1.5",
            'cmd' => "GET_OBJECTS",
        ]);

        foreach ($request->json() as $data) {

            gpsObject::updateOrCreate([
                'imei' => $data['imei'],
            ], [
                'active'           => $data['active'],
                'object_expire'    => $data['object_expire'],
                'model'            => $data['vehicle'],
                'object_expire_dt' => $data['object_expire_dt'],
                'name'             => $data['name'] ?? '',

            ]);

        }
        return true;

    }
}
