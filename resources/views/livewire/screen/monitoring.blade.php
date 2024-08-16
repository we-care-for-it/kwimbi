<div class="container-fluid pt-2" wire:poll="load_data">
  <div class="row">
    <div class="col-md-2" style="height: 110px">
      <div style="border-radius: 10px;  padding: 10px; background-color: white">
        <h5>Totaal liften</h5>
        <br>
        <h2> {{$cnt_all_elevators}}</h2>
      </div>
    </div>
    <div class="col-md-4">
      <div style="height: 110px; border-radius: 10px;  padding: 10px; background-color: white">
        <div class="d-flex justify-content-between">
          <div>
            <center>
              <img style="height: 80px; margin-top: 6px;" src="/assets/img/liftadvies.png"">
            </center>
          </div>
          <div>
            <h2 style="margin-top:28px;"> {{$cnt_all_elevators - $cnt_managment_elevators}} </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div style="height: 110px; border-radius: 10px;  padding: 10px; background-color: white">
        <div class="d-flex justify-content-between">
          <div>
            <center>
              <img style="height: 80px; margin-top: 6px;" src="/assets/img/liftbeheerlogo.png">
            </center>
          </div>
          <div>
            <h2 style="margin-top:30px;"> {{$cnt_managment_elevators}} </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div style="height: 110px; border-radius: 10px;  padding: 10px; background-color: white">
        <h2 style="margin-top:30px;">
          <center>
            </center>
        </h2>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
<div style = "height: 30px;"></div>
  <div class="row">
    <div class="col-md-6">
      <div class="card" style="border-radius: 10px;">
        <div class="card-body" style="padding-top: 5px">
          <div class="card-title"> Storingen </div>
          <canvas wire:ignore id="incidentchart" height="100px"></canvas>



            <script type="text/javascript">
            const data_incidentchart = {
      labels: {{ Js::from($month_labels) }},
      datasets: [
                {
                  label: 'Stilstaand',
                  type: 'bar',
                  borderColor: [
                    'rgb(54, 162, 235)'
                  ],
                  backgroundColor: '#03A9EA',
                  data: {{ Js::from($stand_still_data) }},
                  },
                  {
                    label: 'Storingen per maand',
                    backgroundColor: [
                      'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                      'rgb(54, 162, 235)',
                    ],
                    borderWidth: 1,
                    data: {{ Js::from($incidents) }},
                  },
                ]
              };

const config_incidentchart = {
type: 'bar',
data: data_incidentchart,
options: {}
};

const incidentchart = new Chart(
document.getElementById('incidentchart'),
config_incidentchart
);

</script>

         </div>
      </div>
   </div>



    <div class="col-md-6">
      <div class="card" style = "border-radius: 10px;">
          <div class="card-body"  style = "padding-top: 5px">
            <div class="card-title">
   Keuringen ( 2024 )
            </div>


             <canvas wire:ignore id="inspection_error_chart"  height="100px"></canvas>
             <script type="text/javascript">

const inspections_error_data = {
                  labels: {{ Js::from($month_labels) }},
                  datasets: [  {
                    label: 'Goedgekeurd',
                    type: 'bar',
                    backgroundColor: [

                    'rgba(144,238,144, 0.2)',

  ],
  borderColor: [
    '	rgb(34,139,34)',

  ],
                borderWidth: 1,
                    data: {{ Js::from($inspections_data) }},
                  } ,
                  {
                    label: 'Afgekeurd',
                    type: 'bar',
                    backgroundColor: [
    'rgba(255, 99, 132, 0.2)',

  ],
  borderColor: [
    'rgb(255, 99, 132)',

  ],
                borderWidth: 1,
                    data: {{ Js::from($inspections_error_data) }},
                  },
                  {
                   label: 'Onbeslist / niet afgerond',
                   type: 'bar',
                   backgroundColor: [
                     'rgba(54, 162, 235, 0.2)',
                   'rgba(144,238,144, 0.2)',

 ],
 borderColor: [
   'rgb(54, 162, 235)',

 ],
               borderWidth: 1,
                   data: {{ Js::from($inspections_unknow_data) }},
                 } ,

                ]
                };

                const config_chart_1 = {
                  type: 'bar',
                  data: inspections_error_data,
                  options: {}
                };

                const myChart_chart_1 = new Chart(
                  document.getElementById('inspection_error_chart'),
                  config_chart_1
                );
             </script>
          </div>
       </div>
    </div>
   </div>
   <h5>Storingen</h5>
 <div class="row" >


   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Doorgestuurd naar ohb</h5>
       <br>
       <h2>{{count($incident_cnt_by_status[2])}}</h2>
     </div>
   </div>
   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Wacht op offerte</h5>
       <br>
       <h2>{{count($incident_cnt_by_status[3])}}</h2>
     </div>
   </div>
   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Offerte naar klant</h5>
       <br>
       <h2>{{count($incident_cnt_by_status[4])}}</h2>
     </div>
   </div>
   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Offerte in opdracht</h5>
       <br>
       <h2>{{count($incident_cnt_by_status[7])}}</h2>
     </div>
   </div>
   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Werkzaamheden gepland</h5>
       <br>
       <h2>{{count($incident_cnt_by_status[8])}}</h2>
     </div>
   </div>
   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h4 class = "text-success"><i class="fa-solid fa-check"></i> Gereed</h4>
       <br>
       <h2 class = "text-success">{{count($incident_cnt_by_status[99])}}</h2>
     </div>
   </div>
</div>
<br>
 <div   style = "clear-fix"></div>


 <h5>Keuringen</h5>


<div class="row  " >

<div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Goedgekeurd</h5>
       <br>
       <h2>{{count($elevators->where('inspection_status_id', 1))}}</h2>
     </div>
   </div>


   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Goedgekeurd met acties</h5>
       <br>
       <h2>{{count($elevators->where('inspection_status_id', 2))}}</h2>
     </div>
   </div>


   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Afgekeurd <small>({{count($elevators->where('inspection_status_id', 3))}})</small></h5>
       <br>
       <h2>
        {{count($elevators->where('inspection_status_id', 3)) - count($elevators->where('inspection_status_id', 3)->where('management_elevator', 1))}}  
    /
  
    <span class = "text-primary"  > <i class="fa-solid fa-user-gear fa-sm"> </i>   </span>
     {{count($elevators->where('inspection_status_id', 3)->where('management_elevator', 1))}}

    </h2>
  </div>
   </div>

   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Niet afgerond</h5>
       <br>
       <h2>{{count($elevators->where('inspection_status_id', 4))}}</h2>
     </div>
   </div>

   <div class="col-md-2" >
     <div style="border-radius: 10px;  padding: 10px; background-color: white">
       <h5>Niet afgerond</h5>
       <br>
       <h2>{{count($elevators->where('inspection_status_id', 5))}}</h2>
     </div>
   </div>

   <div class="col-md-2"  >
     <div style="border-radius: 10px;  padding: 10px; background-color: white" style = "border 1px  dotted red ">
       <h5>Stilstaand</h5>
       <br>
       <h2>{{count($elevator_standing_still)}}</h2>
     </div>
   </div>


   </div>     </div>
