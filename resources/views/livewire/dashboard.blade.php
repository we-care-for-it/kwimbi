<div class="container-fluid">
   <div class="row">
      <div class="col-md-2">
         <div class="card">
            <div class="card-body">
               <div>
                  <h6 class="font-size-xs text-uppercase">Aantal liften</h6>
                  <span class = "text-success"> {{count($elevators->where('status_id',1))}} actief</span>  / 
                  <span class = "text-danger  "> {{count($elevators->where('status_id',2))}} niet actief</span>
               </div>
            </div>
         </div>
      </div>


      <div class="col-md-2">
         <div class="card">
            <div class="card-body">
               <div>
               <h6 class="font-size-xs text-uppercase">Aantal Storingen</h6>
               <span class = "text-warning"> {{count($elevator_open_incidents)}} Actueel</span>
               </div>
            </div>
            </div>
      </div>

      <div class="col-md-2">
         <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <div>
                  <h6 class="font-size-xs text-uppercase">Lopende projecten</h6>
                  {{$cnt_all_projects}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
                 

   <div class="row pt-3">
      <div class="col-md-6">
         <div class="card" style = "height: 480px;">
            <div class="card-header card-header-content-md-between bg-light">
               Actuele storingen
               <span class="badge bg-primary rounded-pill ms-1">{{count($elevator_open_incidents)}}</span>
            </div>
            <div class = "card-body">
               <div style = "overflow-x: auto; height: 380px; overflow-x: hidden">
                  @if(count($elevator_open_incidents))
                  <table class="table table-striped">
                     <tbody>
                        @foreach ($elevator_open_incidents as $incident)
                        <tr style = "cursor: pointer; " onclick="window.location='/incident/{{ $incident->id }}';">
                     
<td>
                         

   @if ($incident->status_id == 0)
   <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Nieuw
   </span>
   @elseif($incident->status_id == 2)
   <span  class="badge bg-soft-primary text-primary py-2">Doorgestuurd naar
   onderhoudsbedrijf
   </span>
   @elseif($incident->status_id == 99)
   <span  class="badge bg-soft-primary text-primary py-2">Gereed
   </span>
   @elseif($incident->status_id == 3)
   <span  class="badge bg-soft-primary text-primary py-2">Wacht op offerte
   </span>
   @elseif($incident->status_id == 4)
   <span  class="badge bg-soft-primary text-primary py-2">Offerte naar klant gestuurd
   </span>
   @elseif($incident->status_id == 5)
   <span  class="badge bg-soft-primary text-primary py-2">Niet gereed
   </span>
   @elseif($incident->status_id == 6)
   <span  class="badge bg-soft-primary text-primary py-2">Onjuist gemeld
   </span>
   @elseif($incident->status_id == 7)
   <span  class="badge bg-soft-primary text-primary py-2">Offerte in opdracht
   </span>
   @elseif($incident->status_id == 8)
   <span  class="badge bg-soft-primary text-primary py-2"> Werkzaamheden gepland
   </span>
   @endif
 
</td>      <td  >
                              <small>
                              {{ Carbon\Carbon::parse($incident->created_at)->format('d-m-Y') }}
                              <br>  
                              
                                 Geupdate op: {{ Carbon\Carbon::parse($incident->updated_at)->format('d-m-Y') }} om {{ Carbon\Carbon::parse($incident->updated_at)->format('H:m:s') }}
                        
                              </small>
                           </td>
                           <td>
                              @if($incident->elevator->management_elevator)
                              <span class = "text-primary"  > <i class="fa-solid fa-user-gear"> </i>   </span>
                              @endif
                              <small>
                              {{$incident->elevator?->address?->name}}
                              {{$incident?->elevator?->address?->address }},
                              {{$incident?->elevator?->address?->housenumber}}
                              <br>
                              {{ $incident?->elevator?->address?->zipcode }},
                              {{$incident?->elevator?->address?->place }}
                              </small>

                           </td>
               </div>
               </tr>
               @endforeach
               </tbody>
               </table>
               @else
               Alle liften zijn operationeel
               @endif
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="card" style = "height: 480px;">
         <div class="card-header card-header-content-md-between bg-light">
            Stilstaande liften
            <span class="badge bg-primary rounded-pill ms-1">{{count($elevator_standing_still)}}</span>
         </div>
         <div class = "card-body">
            <div style = "overflow-x: auto; height: 380px; overflow-x: hidden">
               @if(count($elevator_standing_still))
               <table class="table table-striped ">
                  <tbody>
                     @foreach ($elevator_standing_still as $incident)
                     <tr style = "cursor: pointer; " onclick="window.location='/incident/show/{{ $incident->id }}';">
                        <td>
                           <small>
                           {{ Carbon\Carbon::parse($incident->created_at)->format('d-m-Y') }}
                           </small>
                        </td>
                        <td>
                           @if($incident->elevator->management_elevator)
                           <span class = "text-primary"  > <i class="fa-solid fa-user-gear"> </i>   </span>
                           @endif
                           <small>
                           <span >	<b>{{$incident->elevator?->address?->name}}</b></a>
                           {{$incident?->elevator?->address?->address }},
                           {{$incident?->elevator?->address?->housenumber}}
                           <br>
                           {{ $incident?->elevator?->address?->zipcode }},
                           {{$incident?->elevator?->address?->place }}
                           </small>
                        </td>
            </div>
            <td>
            <small>	{{$incident->description}}
            </small>

       

            @if ($incident->status_id == 0)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Nieuw
            </span>
            @elseif($incident->status_id == 2)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Doorgestuurd naar
            onderhoudsbedrijf
            </span>
            @elseif($incident->status_id == 99)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Gereed
            </span>
            @elseif($incident->status_id == 3)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Wacht op offerte
            </span>
            @elseif($incident->status_id == 4)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Offerte naar klant gestuurd
            </span>
            @elseif($incident->status_id == 5)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Niet gereed
            </span>
            @elseif($incident->status_id == 6)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Onjuist gemeld
            </span>
            @elseif($incident->status_id == 7)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2">Offerte in opdracht
            </span>
            @elseif($incident->status_id == 8)
            <span style = "float: right" class="badge bg-soft-primary text-primary py-2"> Werkzaamheden gepland
            </span>
            @endif
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            @else
            Er zijn geen liften die stilstaan door een storing
            @endif
         </div>
      </div>
   </div>
</div>
</div>
<div class="row pt-3">
<div class="col-md-6">
   <div class="card" style = "height: 360px;">
      <div class="card-header card-header-content-md-between bg-light">
         Afgekeurde liften      
      </div>
      <div class = "card-body">
         <div style = "overflow-x: auto; height: 380px; overflow-x: hidden">
            @if(count($elevator_rejected_inspections))
            <table class="table table-striped table-hover ">
               <tbody>
                  @foreach ($elevator_rejected_inspections as $elevator)
                 
                  <tr style = "cursor: pointer; " onclick="location = '/elevator/show/{{$elevator->id}}'">

                     <td>
                        
                        @if($elevator->status_id=='2')
                        <div class="cnt_table_result">
                        <i class="fa-solid fa-building-circle-xmark text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Lift buiten gebruik"></i>
                        </div>
                        @endif
                        @if($elevator->status_id=='1')
                        <div class="cnt_table_result">
                        <i class="fa-solid fa-building-circle-check text-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Operationeel"></i>
                        </div>
                        @endif
                                       @if($elevator->fire_elevator)
                                       <div class="cnt_table_result pl-0 ml-0">
                                          <i  data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift" class = "text-danger bi bi-fire"></i>
                                       </div>
                                       @else
                                       <div class="cnt_table_result">
                                          <i  style = "color: #EFEFEF" class = " bi bi-fire"></i>
                                       </div>
                                       @endif
                                       @if($elevator->stretcher_elevator)
                                       <div class="cnt_table_result">
                                          <i  data-bs-toggle="tooltip" data-bs-placement="top" title="Brancard / Bedlift" class = "text-primary fa-solid fa-bed"></i>     
                                       </div>
                        </div>
                        @else
                        <div class="cnt_table_result">
                        <i  style = "color: #EFEFEF" class = " fa-solid fa-bed"></i>
                        </div>
                        @endif

                     </td>
                     <t>
                  <td>
                     @if($elevator?->object_type_id)
                     <small>
                     {{config('globalValues.object_types')[$elevator?->object_type_id]}}</small>
                     @endif
                  </td>
                     <td style = "width: 200px;">
                        @if($elevator->management_elevator)
                        <span class = "text-primary"  > <i class="fa-solid fa-user-gear"> </i>   </span>
                        @endif
                        {{ Carbon\Carbon::parse($elevator->inspections[0]->executed_datetime)->format('d-m-Y') }}
                     </td>
                     <td><span class="text-danger py-2 "> Afgekeurd </span>
                     </td>

                     
                     <td>
                        <small>
                        <span >
                        <b>{{$elevator->address?->name}}</b></a>
                        {{$elevator?->address?->address }},
                        {{$elevator?->address?->housenumber}}
                        <br>
                        {{ $elevator?->address?->zipcode }},
                        {{$elevator?->address?->place }}
                        </small>
                     <td>
                        @if(!$elevator->remark) {{$elevator->remark}}  @endif
                     </td>
         </div>
         <td>
         <small>
         </small>
         </td>
         </tr>
       
         @endforeach
         </tbody>
         </table>
         @else
         Geen storing gevonden
         @endif
      </div>
   </div>
</div>
</div>
<div class="col-md-6">
<div class="card" style = "height: 360px;">
   <div class="card-header card-header-content-md-between bg-light">
      Verlopen keuringen
   </div>

   <div class = "card-body">
      <div style = "overflow-x: auto; height: 380px; overflow-x: hidden">
         @if(count($elevator_expired_inspections))
         <table class="table table-striped table-hover ">
            <tbody>
               @foreach ($elevator_expired_inspections as $inspection)
              

               <tr style = "cursor: pointer; " onclick="window.location='/elevator/show/{{ $inspection->elevator_id }}';">
                     
                      <td  >
                                                <small>
                                               
                                                   Afgekeurd op: {{ Carbon\Carbon::parse($inspection->end_date)->format('d-m-Y') }} 
                                                <br>  
                                                
                                               
                                                {{ \Carbon\Carbon::parse($inspection->end_date)->diffForHumans() }}
                                                </small>
                                             </td>
                                             <td>
                                              
                                                <small>
                                                {{$inspection->elevator?->address?->name}}
                                                {{$inspection?->elevator?->address?->address }},
                                                {{$inspection?->elevator?->address?->housenumber}}
                                                <br>
                                                {{ $inspection?->elevator?->address?->zipcode }},
                                                {{$inspection?->elevator?->address?->place }}
                                                </small>
                  
                                             </td>
                                 </div>
                                 </tr>



            
 
      @endforeach
      </tbody>
      </table>
      @else
   Geen afgekeurde liften gevonden
      @endif
   </div>



  
</div>
</div>
</div>
</div>

   </div>