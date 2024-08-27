<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elevator;
use App\Models\Location;
use App\Models\maintenances;
use App\Models\Inspection;

class ApiObject extends Controller
{
    public function __invoke(Request $request)
    {
        $object_results = Elevator::where('nobo_no', $request->object_nobo)
            ->select('id','address_id', 'unit_no')
            ->first();

        if (!$object_results)
        {
            $response = [
              'status'  => 404,
              'message' => 'Mo objects found'
            ];
        }
        else
        {
            $object_address = Location::where('id', $object_results->address_id)
                ->select('name', 'address', 'zipcode', 'place', 'complexnumber')
                ->get();

            $object_inspections = Inspection::where('elevator_id', $object_results->id)
                ->select('executed_datetime', 'remark', 'document', 'status_id', 'end_date', 'certification')
                ->get();

            $object_maintenances = maintenances::where('elevator_id', $object_results->id)
                ->select('planned_at', 'status_id', 'remark', 'executed_datetime', 'attachment')
                ->get();

            $response = [
              'status'        => 200,
              'object_info'   => $object_results,
              'address'       => $object_address,
              'inspections'   => $object_inspections,
              'maintenances'  => $object_maintenances,
            ];

        }
        return response()->json($response, $response['status']);
    }
}
