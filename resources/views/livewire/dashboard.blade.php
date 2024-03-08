<div class="container-fluid">
   <div class="row">
      <div class="col-xl-3 col-sm-5">
         <!-- Card -->
         <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <div>
                     <h6 class="font-size-xs text-uppercase">Aantal liften</h6>
                     <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center">
                        {{$cnt_all_elevators}}
                     </h4>
                  </div>
                  <div>
                     <div>
                        <div class="view">
                           <a href="/company/elevators" class="btn btn-soft-secondary btn-sm">Bekijk alle <i class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-3 col-sm-5">
         <!-- Card -->
         
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
                        <tr style = "cursor: pointer; " onclick="window.location='/company/incident/show/{{ $incident->id }}';">
                           <td  >      
                           <small>
							 {{ Carbon\Carbon::parse($incident->created_at)->format('d-m-Y') }}
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
               </div>
          
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
            Geen storing gevonden
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

      

               @if(count($elevator_expired_inspections))
               <table class="table table-striped ">
                  <tbody>
                     @foreach ($elevator_expired_inspections as $elevator)

                     @if($elevator->inspections[0]->status_id ==3)
                     <tr style = "cursor: pointer; " onclick="">
                        <td style = "width: 200px;">
                        @if($elevator->management_elevator)
								  <span class = "text-primary"  > <i class="fa-solid fa-user-gear"> </i>   </span>
								  @endif
							 
                       
                          
                          {{ Carbon\Carbon::parse($elevator->inspections[0]->executed_datetime)->format('d-m-Y') }}
                        </td>
                        <td><span class="badge badge-soft-danger py-2 "> Afgekeurd </span>
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

            @endif
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
   </div>
</div>
</div>
</div>
</div>