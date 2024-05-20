<?php

namespace App\Http\Controllers\Api\Endpoints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\Elevator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TuvController extends Controller
{
  

    public $data;
    public $html;
    public $input;

    public function handleWebhook(Request $request)
    {

        $this->webhookUser     =  env('TUV_USERNAME',null);
        $this->webhookPass     =  env('TUV_PASSWORD',null);

        $logged = false;
        if ($request->header('PHP_AUTH_USER', null) && $request->header('PHP_AUTH_PW', null)) {

            $username = $request->header('PHP_AUTH_USER');
            $password = $request->header('PHP_AUTH_PW');

            if ($username === $this->webhookUser && $password === $this->webhookPass) {
                $logged = true;
            }
        }


 
        if ($logged === false) {
            $headers = ['WWW-Authenticate' => 'Basic'];
            return response()->make('Invalid credentials.', 401, $headers);
        } else {
            $input =  $request->input('Body');
            
            $this->input = $input;

            switch ($input['Inspection_Result']['Result']) {
                case "Is goedgekeurd":
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

            $insert_array = [
                'inspection'            => isset($input['Relations']) ? json_encode($input['Inspection']) : null,
                'location'              => isset($input['Location']) ? json_encode($input['Location']) : null,
                'relations'             => isset($input['Relations']['Relation']) ? json_encode($input['Relations']['Relation']) : null,
                'data'                  => isset($input['Object_Data']) ? json_encode($input['Object_Data']) : null,
                'inspection_data'       => isset($input['Inspection_Data']) ? json_encode($input['Inspection_Data']) : null,
                'inspection_results'    => isset($input['Inspection_Result']) ? json_encode($input['Inspection_Result']) : null,
                'zin_codes'             => isset($input['Inspection_Result']['ZIN']) ? json_encode($input['Inspection_Result']['ZIN']) : null,
                'end_date'              => Carbon::parse($input['Inspection_Data']['Next_Inspection_Date'])->format('Y-m-d'),
                'executed_datetime'     => Carbon::parse($input['Inspection_Data']['Inspection_Date'])->format('Y-m-d'),
                'status_id'             => $status_id,
            ];

            $inspection =  Inspection::create(
                $insert_array
            );

            $nobo_nr    = $input['Object_Data']['Tuev_ID'];
            $elevator   = Elevator::where('nobo_no', '=', $nobo_nr)->first();

            if($elevator) {
                $inspection_update = Inspection::where('id', $inspection->id)
                ->update(
                    [
                        'if_match'      => 1,
                        'elevator_id'   => $elevator->id
                    ]
                );
                $insert_array['if_match'] = 1;
            }



            $image = $input['certificate_data']['testing_certificate_file'];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 's.png';




            // $directory =
            // $elevator->address->customer_id .
            //     "/" .
            //     $elevator->id .
            //     "/uploads/" .
            //    'sss';


            // Storage::disk("sftp")->putFileAs($directory, base64_decode($image), $imageName);


            // $files = [];
            //use ($data, $files)
            // $files = [
            //     storage_path() . '/' . $imageName, base64_decode($image)
            // ];

            $data = preg_replace('/>\s+</', "><", $insert_array);
            Mail::mailer()->send('emails.add_inspection', $data, function ($message) {

                $message->subject('TÜV Keuringsrapportage toegevoegd  #' . $this->input['Location']['Street']);
                $message->to("storing@lvaliftadvies.nl", "Storingen");
                // foreach ($files as $file) {
                //     $message->attach($file);
                // };
                $message->bcc("info@wecareforit.nl", "Storingen");
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_name'));
            });

            return response()->json(
                [
                   'success'   => true,
                //    'id'        =>  $inspection->id,
                ],
                201
            );
        }

    }
}
//
