<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectMonitoring;

class ObjectMonitoringController extends Controller
{
    public function retrieveInfo(Request $request){
        try {
            ObjectMonitoring::create([
                'sensor01' => $request->sensor01 ?? null,
                'sensor02' => $request->sensor02 ?? null,
                'sensor03' => $request->sensor03 ?? null,
                'sensor04' => $request->sensor04 ?? null,
                'sensor05' => $request->sensor05 ?? null,
            ]) ;
            echo http_response_code(200);


            } catch(Exception $e) {
            echo http_response_code(500);
          } 
        

    }
}
