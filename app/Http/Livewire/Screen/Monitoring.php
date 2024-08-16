<?php

namespace App\Http\Livewire\Screen;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

use App\Models\Incident;
use App\Models\Inspection;
use App\Models\Elevator;

use DB;

class Monitoring extends Component
{
    public $incidents_standstill;
    public $all_incidents;
    public $incident_cnt_by_status;
    public $cnt_managment_elevators;
    public $cnt_all_elevators;
    public $elevators = [];
    public $elevator_standing_still;


    public function inArray($array)
    {

        if (in_array("mac", $os)) {
            echo "Got mac";
        }


    }

    public function load_data(){
        $this->elevator_standing_still = Incident::where('status_id', '!=', '99') ->where('status_id', '!=', '6')->where('stand_still', 1)->orderby('report_date_time', 'desc')->get();
  
      //Incidenten bij status
      $this->incident_cnt_by_status =  array(
          "1"  =>   Incident::where('status_id', 1)->get(),
          "2"  =>   Incident::where('status_id', 2)->get(),
          "3"  =>   Incident::where('status_id', 3)->get(),
          "4"  =>   Incident::where('status_id', 4)->get(),
          "5"  =>   Incident::where('status_id', 5)->get(),
          "6"  =>   Incident::where('status_id', 6)->get(),
          "7"  =>   Incident::where('status_id', 7)->get(),
          "8"  =>   Incident::where('status_id', 8)->get(),
          "99"  =>   Incident::where('status_id', 99)->get()
          );



          $this->cnt_all_elevators         =  Elevator::whereNull('archive')->count();
          $this->cnt_managment_elevators   =  Elevator::whereNull('archive')->where('management_elevator', 1)->count();




    }


    public function render()
    {

      $this->load_data();

        //Grafieken per maand incidenten
        $incidents_data = Incident::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(report_date_time) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->orderBy('id', 'ASC')
                    ->groupBy('id')
                    ->pluck('count', 'month_name');



        $month_labels = array(

        "0"  =>  "Jan",
        "1"  =>  "Feb",
        "2"  =>  "Maa",
        "3"  =>  "Apr",
        "4"  =>  "Mei",
        "5"  =>  "Jun",
        "6"  =>  "Jul",
        "7"  =>  "Aug",
        "8"  =>  "Sep",
        "9"  =>  "Okt",
        "10"  =>  "Nov",
        "11"  =>  "Dec"


        )  ;

        $incidents =  array(

            "0"  =>  isset($incidents_data['January']) ? $incidents_data['January'] : null,
            "1"  =>  isset($incidents_data['February']) ? $incidents_data['February'] : null,
            "2"  =>  isset($incidents_data['March']) ? $incidents_data['March'] : null,
            "3"  =>  isset($incidents_data['April']) ? $incidents_data['April'] : null,
            "4"  =>  isset($incidents_data['May']) ? $incidents_data['May'] : null,
            "5"  =>  isset($incidents_data['June']) ? $incidents_data['June'] : null,
            "6"  =>  isset($incidents_data['July']) ? $incidents_data['July'] : null,
            "7"  =>  isset($incidents_data['August']) ? $incidents_data['August'] : null,
            "8"  =>  isset($incidents_data['September']) ? $incidents_data['September'] : null,
            "9"  =>  isset($incidents_data['October']) ? $incidents_data['October'] : null,
            "10" =>  isset($incidents_data['November']) ? $incidents_data['November'] : null,
            "11" =>  isset($incidents_data['December']) ? $incidents_data['December'] : null,
            );



        //Grafieken per stilstand
        $data = Incident::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->where('stand_still', 1)
        ->groupBy(DB::raw("month_name"))
        ->orderBy('id', 'ASC')
        ->pluck('count', 'month_name');




        $stand_still_data =  array(

        "0"  =>  isset($data['January']) ? $data['January'] : null,
        "1"  =>  isset($data['February']) ? $data['February'] : null,
        "2"  =>  isset($data['March']) ? $data['March'] : null,
        "3"  =>  isset($data['April']) ? $data['April'] : null,
        "4"  =>  isset($data['May']) ? $data['May'] : null,
        "5"  =>  isset($data['June']) ? $data['June'] : null,
        "6"  =>  isset($data['July']) ? $data['July'] : null,
        "7"  =>  isset($data['August']) ? $data['August'] : null,
        "8"  =>  isset($data['September']) ? $data['September'] : null,
        "9"  =>  isset($data['October']) ? $data['October'] : null,
        "10" =>  0,
        "11" =>  isset($data['December']) ? $data['December'] : null,
        );












        $inspections_data =  array(

        "0"  =>  isset($data['January']) ? $data['January'] : null,
        "1"  =>  isset($data['February']) ? $data['February'] : null,
        "2"  =>  isset($data['March']) ? $data['March'] : null,
        "3"  =>  isset($data['April']) ? $data['April'] : null,
        "4"  =>  isset($data['May']) ? $data['May'] : null,
        "5"  =>  isset($data['June']) ? $data['June'] : null,
        "6"  =>  isset($data['July']) ? $data['July'] : null,
        "7"  =>  isset($data['August']) ? $data['August'] : null,
        "8"  =>  isset($data['September']) ? $data['September'] : null,
        "9"  =>  isset($data['October']) ? $data['October'] : null,
        "10" =>  isset($data['November']) ? $data['November'] : null,
        "11" =>  isset($data['December']) ? $data['December'] : null,
        );


        //Grafieken per keuringen
        $data = Inspection::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(executed_datetime) as month_name"))
        ->whereYear('executed_datetime', date('Y'))
        ->whereIn('status_id', [1,2])
        ->groupBy(DB::raw("month_name"))
        ->orderBy('id', 'ASC')
        ->pluck('count', 'month_name');




        //Grafieken per keuringen
        $inspections_error_query = Inspection::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(executed_datetime) as month_name"))
        ->whereYear('executed_datetime', date('Y'))
        ->where('status_id', 3)
        ->groupBy(DB::raw("month_name"))
        ->orderBy('id', 'ASC')
        ->pluck('count', 'month_name');


        $inspections_error_data =  array(

        "0"  =>  isset($inspections_error_query['January']) ? $inspections_error_query['January'] : null,
        "1"  =>  isset($inspections_error_query['February']) ? $inspections_error_query['February'] : null,
        "2"  =>  isset($inspections_error_query['March']) ? $inspections_error_query['March'] : null,
        "3"  =>  isset($inspections_error_query['April']) ? $inspections_error_query['April'] : null,
        "4"  =>  isset($inspections_error_query['May']) ? $inspections_error_query['May'] : null,
        "5"  =>  isset($inspections_error_query['June']) ? $inspections_error_query['June'] : null,
        "6"  =>  isset($inspections_error_query['July']) ? $inspections_error_query['July'] : null,
        "7"  =>  isset($inspections_error_query['August']) ? $inspections_error_query['August'] : null,
        "8"  =>  isset($inspections_error_query['September']) ? $inspections_error_query['September'] : null,
        "9"  =>  isset($inspections_error_query['October']) ? $inspections_error_query['October'] : null,
        "10" =>  null,
        "11" =>  isset($inspections_error_query['December']) ? $inspections_error_query['December'] : null,
        );



        $inspections_unknow_query = Inspection::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(executed_datetime) as month_name"))
        ->whereYear('executed_datetime', date('Y'))
        ->whereIn('status_id', [4,5])
        ->groupBy(DB::raw("month_name"))
        ->orderBy('id', 'ASC')
        ->pluck('count', 'month_name');


        $inspections_unknow_data =  array(

        "0"  =>  isset($inspections_unknow_query['January']) ? $inspections_unknow_query['January'] : null,
        "1"  =>  isset($inspections_unknow_query['February']) ? $inspections_unknow_query['February'] : null,
        "2"  =>  isset($inspections_unknow_query['March']) ? $inspections_unknow_query['March'] : null,
        "3"  =>  isset($inspections_unknow_query['April']) ? $inspections_unknow_query['April'] : null,
        "4"  =>  isset($inspections_unknow_query['May']) ? $inspections_unknow_query['May'] : null,
        "5"  =>  isset($inspections_unknow_query['June']) ? $inspections_unknow_query['June'] : null,
        "6"  =>  isset($inspections_unknow_query['July']) ? $inspections_unknow_query['July'] : null,
        "7"  =>  isset($inspections_unknow_query['August']) ? $inspections_unknow_query['August'] : null,
        "8"  =>  isset($inspections_unknow_query['September']) ? $inspections_unknow_query['September'] : null,
        "9"  =>  isset($inspections_unknow_query['October']) ? $inspections_unknow_query['October'] : null,
        "10" =>  null,
        "11" =>  isset($inspections_unknow_query['December']) ? $inspections_unknow_query['December'] : null,
        );







        $inspections_data =  array(

            "0"  =>  isset($data['January']) ? $data['January'] : null,
            "1"  =>  isset($data['February']) ? $data['February'] : null,
            "2"  =>  isset($data['March']) ? $data['March'] : null,
            "3"  =>  isset($data['April']) ? $data['April'] : null,
            "4"  =>  isset($data['May']) ? $data['May'] : null,
            "5"  =>  isset($data['June']) ? $data['June'] : null,
            "6"  =>  isset($data['July']) ? $data['July'] : null,
            "7"  =>  isset($data['August']) ? $data['August'] : null,
            "8"  =>  isset($data['September']) ? $data['September'] : null,
            "9"  =>  isset($data['October']) ? $data['October'] : null,
            "10" =>  null,
            "11" =>  isset($data['December']) ? $data['December'] : null,
            );








        $this->all_incidents = Incident::where('status_id', '!=', 99)->limit(6)->get();


        return view('livewire.screen.monitoring',

        compact('inspections_unknow_data','inspections_data', 'month_labels', 'incidents', 'stand_still_data', 'inspections_data', 'inspections_error_data'))->layout('layouts.screen')

      ->layout('layouts.screen');

        //, ;

    }

    public function mount()
    {

        $this->incidents_standstill  = Incident::get();
        $this->elevators  = Elevator::get();

    }





}
