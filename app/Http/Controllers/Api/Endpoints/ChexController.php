<?php

namespace App\Http\Controllers\Api\Endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\Elevator;

use App\Models\inspectionData;
use Carbon\Carbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ChexController extends Controller
{
    public $data;
    public $html;
    public $input;

    public function handleWebhook(Request $request)
    {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://api.chex.nl/api/v1/inspections?fromDate=2024-05-05"
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: " .
            "3FD8F2DC671135FF0561DF1FB2CF5173452EAC2785089AD0F1FA96DC1938CE7D",
        ]);

        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        $records = json_decode($body)->result;

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

            $inspection_data_from_db = Inspection::updateOrCreate(
                [
                    "external_uuid" => $item->inspectionId,
                ],

                [
                    "status_id" => $status_id,
                    "inspection_company_id" => 3,
                    "type" => $item->inspectionType,
                    "nobo_number" => $item->objectId,
                    "elevator_id" => $elevator_information->id,
                    "executed_datetime" => $item->inspectionDate,
                    "if_match" => isset($elevator_information->id) ? 1 : 0,
                    "end_date" => $item->expiryDate,
                ]
            );

            //Get all inpection details
            $ch = curl_init();
            curl_setopt(
                $ch,
                CURLOPT_URL,
                "https://api.chex.nl/api/v1/inspections/" . $item->inspectionId
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: " .
                "3FD8F2DC671135FF0561DF1FB2CF5173452EAC2785089AD0F1FA96DC1938CE7D",
            ]);

            $response = curl_exec($ch);
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $records = json_decode($body)->result;

            // //Read certifcation file
           Inspection::where("external_uuid", $item->inspectionId)->update([
               "document"       => $records->reportData,
               "certification"  => $records->certificateData,
               
           ]);

            foreach ($records->comments as $item) {
           
             inspectionData::updateOrCreate(
                [
                    "inspection_id" =>$inspection_data_from_db->id,
                    "zin_code" => $item->code,
                ], [
                    "zin_code" => $item->code,
                    "comment" => $item->comment,
                    "type" => $item->type,
                    "inspection_id" =>   $inspection_data_from_db->id,
                    "status" => $item->status,
                ]);
            }
        }
    }
}

