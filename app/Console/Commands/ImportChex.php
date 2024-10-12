<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ObjectInspection;
use App\Models\Elevator;
use App\Models\ObjectInspectionData;
use App\Models\ExternalApiLog;

use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;
use Throwable;

class ImportChex extends Command
{
    protected $signature = "app:import-chex";
    protected $description = "Import Chex inspections";

    public function handle()
    {

        try {
          

        $url = config("services.chex.url") . "/inspections";
        $schedule_run_token = Str::random();
        $response = Http::withHeaders([
            "Authorization" => config("services.chex.token"),
        ])->get($url, [
            "fromDate" => "2024-09-09",
        ]);

        $records = json_decode($response->getBody())->result;

        foreach ($records as $item) {
            switch ($item->status) {
                case "Goedgekeurd":
                    $status_id = 1;
                    break;
                case "Goedgekeurd met acties":
                    $status_id = 2;
                    break;
                case "Afgekeurd":
                    $status_id = 3;
                    break;
                case "Onbeslist":
                    $status_id = 4;
                    break;
            }

            $elevator_information = Elevator::where(
                "nobo_no",
                $item->objectId
            )->first();

            $inspection_data_from_db = ObjectInspection::updateOrCreate(
                ["external_uuid" => $item->inspectionId],

                [
                    "status_id"             => $status_id,
                    "inspection_company_id"  => config("services.chex.company_id"),
                    "type"                   => $item->inspectionType,
                    "nobo_number" => $item->objectId,
                    "elevator_id" => $elevator_information?->id,
                    "executed_datetime" => $item->inspectionDate,
                    "if_match" => isset($elevator_information->id) ? 1 : 0,
                    "end_date" => $item->expiryDate,
                    "schedule_run_token" =>  $schedule_run_token

                ]
            );

            $url =  config("services.chex.url") . "/inspections/" . $item->inspectionId;

            $response = Http::withHeaders([
                "Authorization" => config("services.chex.token"),
            ])->get($url);

            $records = json_decode($response->getBody())->result;
            $inspection_id = ObjectInspection::where(
                "external_uuid",
                $item->inspectionId
            )->update([
                "document" => $records->reportData,
                "certification" => $records->certificateData,
            ]);

            //Check of of er goedgekeurd is met acties
            if($records->comments && $status_id==1){
                ObjectInspection::where('external_uuid',$item->inspectionId)->update(['status_id' => 2]);
            }

            foreach ($records->comments as $item) {
                if ($item->status == "Herhaling") {
                    ObjectInspection::where(
                        "external_uuid",
                        $inspection_data_from_db->external_uuid
                    )->update(["status_id" => 6]);
                }

                ObjectInspectionData::updateOrCreate(
                    [
                        "inspection_id"     => $inspection_data_from_db->id,
                        "zin_code"          => $item->code,
                    ],
                    [
                        "zin_code"          => $item->code,
                        "comment"           => $item->comment,
                        "type"              => $item->type,
                        "inspection_id"     => $inspection_data_from_db->id,
                        "status"            => $item->status,
                        "schedule_run_token" =>  $schedule_run_token
                    ]
                );
            }
        }


        $logitem = "Check keuringsrapportage opgehaald ";
       
 
        

    } catch (Exception $e) {
        $logitem = "foutmelding" . $e->getMessage();
 
    }  


    ExternalApiLog::Create(
        [
            "model"         => "Keuringinstanties",
            "logitem"       => $logitem,
            "model_sub"     => 'Chex',
            "status_id"     => '1',
            
            "schedule_run_token" =>  $schedule_run_token
        ]
         
    );


    }
}
