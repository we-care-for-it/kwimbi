<div class="container-fluid">


<div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
            @if($object?->fire_elevator)
               <div class="cnt_table_result">

                  <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift"
                     class="text-danger bi bi-fire"></i>
               </div>
               @else
               <div class="cnt_table_result">
                  <i style="color: #EFEFEF" class=" bi bi-fire"></i>
               </div>
               @endif

               @if($object?->address_id)
               {{$object->location?->address}} {{$object->location?->place}}
               @if($object->location?->name)
               ({{$object->location?->name}})
               @endif
               @else

               @endif
         </div>
         <div class="col-auto">
         <a href="/elevator/edit/{{$object->id}}">
               <button type="button" class="btn   btn-link btn-sm ">
                  Wijzig
               </button>
        </a>
               <button type="button" data-bs-toggle="modal" data-bs-target="#add_incident_modal"   "
               class="btn  btn btn-secondary btn-sm   ">
               <i class="uil uil-exclamation-triangle me-2"></i> Storing aanmelden </button>


    

               <button type="button" class="btn btn-primary btn-sm dropdown-toggle btn-120 pl-10  "  
               id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
               Toevoegen
            </button>

            <div class="dropdown-menu  navbar-dropdown-menu" aria-labelledby="navbarNotificationsDropdownSettings">

               <a class="dropdown-item" href="/elevator/maintenance-contract/{{$object->id}}/create">
                  <i class="bi-archive dropdown-item-icon"></i> Onderhoudscontract
               </a>
               <a class="dropdown-item" href="/elevator/maintenance/{{$object->id}}/create">
                  <i class="bi-check2-all dropdown-item-icon"></i> Onderhoudsbeurt
               </a>
           
               <a class="dropdown-item" href="/elevator/inspection/{{$object->id}}/create">
                  <i class="bi-flag dropdown-item-icon"></i> Keuring
               </a>

               <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#add_attachment_modal"  
                  style="cursor: pointer">
                  <i class="bi-gift dropdown-item-icon"></i> Bijlage
               </a>

            </div>



         </div>
      </div>
   </div>
    


   @if($object?->remark)

   <blockquote class="blockquote blockquote-sm mb-4 mt-2">
      <p>{{$object?->remark}}</p>
   </blockquote>
   @endif
 


   @if($object->countIncident)
   <div class=" bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Melding! </strong>
      <span class="block sm:inline">Er is een storing gemeld op deze lift, Kijk bij storingen voor meer informatie
      </span>
   </div>
   <br> @endif @if($object->stand_still)
   <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Melding! </strong>
      <span class="block sm:inline">Lift buitengebruik vanaf:
         {{ Carbon\Carbon::parse($object->stand_still_date)->format('d-m-Y') }}
      </span>
   </div>
   <br> @endif
   <div class="row">

   <div class="col-md-3 col-xs-12">

<div class="card">

   <div class="card-body">
   <div class="row">

      <div class="col-md-3 p-2 ">

         <span class=" ">

            @if($object?->location?->image)
            <center>
               <img class= "avatar-img " style="max-height: 90px" src="/storage/{{$object?->location?->image}}">

               @else
               <img class="avatar-img  " style="max-height: 90px" src="/assets/img/160x160/img2.jpg">

               @endif</center>
         </span>
      </div>
      <div class="col-md-6  p-2">
         <a class="text-dark" href="/location/{{$object?->location?->slug}}"">
                      @if($object?->location?->name)
                      {{$object?->location?->name}} @else Geen naam @endif</a>
                      <br>
{{$object?->location?->address}}<br>
{{$object?->location?->zipcode}} {{$object?->location?->place}}
<br>
      <div>
         @if($object?->location?->building_type_id)
         <span
            class=" badge bg-soft-primary text-primary py-1">{{config('globalValues.building_types')[$object?->location->building_type_id]}}</span>
         @else

         @endif    <small>{{$object?->location?->customer?->name}}</small>

      </div>

   </div>

</div>
<!-- Body -->

<!-- End Body -->

<!-- End Card -->
</div>
</div>

<div class="card mt-3">
<div class="card-body">
   <div>

      <!-- End Col -->

      <table class="table table-sm " style="margin: 1px;">
         <tr>
            <td>Leverancier</td>
            <td>@if($object?->supplier?->name)
               {{$object?->supplier?->name}}
               @else <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span> @endif
            </td>
         </tr>
         <tr>
            <td>Bouwjaar</td>
            <td>

               @if($object->construction_year)
               {{$object->construction_year}}
               @else
               <span class="badge bg-soft-primary-light text-primary p-1">Geen</span>
               @endif

            </td>
         </tr>

         <tr>
            <td class="align-middle">Status </td>
            <td>
               <span class="badge bg-soft-primary-light text-primary p-1">

                  @if($object->status_id==1)

                  <span class="d-flex align-items-center"> <span class="legend-indicator bg-success"></span>
                     <span class="text-truncate">Operationeel</span></span>
                  @else
                  <span class="d-flex align-items-center"> <span class="legend-indicator bg-danger"></span>
                     <span class="text-truncate">Lift buiten gebruik</span></span>

                  @endif

               </span></td>

         </tr>

         <tr>
            <td class="align-middle">Speek luister/verbinding </td>
            <td>
               <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span>
            </td>
         </tr>

         <tr>
            <td>Keuringstatus</td>
            <td> @if(count($object->inspections))

               @if($object?->latestInspection?->status_id==1)
               <span class="badge bg-soft-success text-success "> Goedgekeurd </span>
               @endif
               @if($object?->latestInspection?->status_id==2)
               <span class="badge bg-soft-primary text-primary ">
                  Goedgekeurd met acties </span>
               @endif
               @if($object?->latestInspection?->status_id==3)
               <span class="badge bg-soft-danger text-danger  "> Afgekeurd </span>
               @endif
               @if($object?->latestInspection?->status_id==4)
               <span class="badge bg-soft-primary text-primary"> Onbeslist </span>
               @endif
               @if($object?->latestInspection?->status_id==5)
               <span class="badge bg-soft-warning text-warning "> Niet afgerond </span>
               @endif

               @else
               Geen keuring uitgevoerd

               @endif</td>

         </tr>

         <tr>
            <td>Nobo nr.</td>
            <td>

               @if($object->nobo_no) {{$object->nobo_no}} @else <span
                  class="badge bg-soft-primary-light text-primary p-1">Geen</span>@endif
            </td>

         </tr>
         <tr>
            <td>UNitnr</td>
            <td>@if($object->unit_no) {{$object->unit_no}} @else <span
                  class="badge bg-soft-primary-light text-primary p-1">Geen</span>@endif
            </td>
         </tr>
         <tr>
            <td>Aantal Stopplaatsen</td>
            <td> @if($object->stopping_places)
               {{$object->stopping_places}}
               @else
               <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span>
               @endif </td>
         </tr>

      </table>

   </div>
</div>
</div>

</div>


      <div class="col-md-9 col-xs-12">

         <div class="row   gy-4  pb-3  ">
            <div class="col-md-4">
               <div class="card p-3 pt-xs-4" style="height: 86px;">
                  @if($object->maintenance_company_id)
                  <ul class="list-unstyled mb-0">
                     <li ">
                           <div class=" d-flex align-items-center">
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Onderhoudbedrijf</p>
                           <span class="mb-0 font-size-14">{{$object?->maintenanceCompany?->name}}</span>
                        </div>
               </div>
               </li>

               </ul>
               @else

               <center class="pt-3">
                  Geen onderhoudsbedrijf
               </center>

               @endif
            </div>

         </div>

         <div class="col-md-4">
            <div class="card p-3  " style="height: 86px;">
               @if($object?->address?->managementcompany)
               <ul class="list-unstyled mb-0">
                  <li class="pb-3">
                     <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Beheerder
                           </p>
                           <span class="mb-0 font-size-14">{{$object?->address?->managementcompany?->name}}
                           </span>
                        </div>
                     </div>
                  </li>
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
               </ul>
               @else
               <center class="pt-3">
                  Geen Beheerder
               </center>
               @endif
            </div>

         </div>
         <div class="col-md-4">


         <div class="card p-3  " style="height: 86px;">
               @if($object?->inspection_company_id)
               <ul class="list-unstyled mb-0">
                  <li class="pb-3">
                     <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Keuringinstantie
                           </p>
                           <span class="mb-0 font-size-14">{{$object?->inspectioncompany?->name}}
                           </span>
                        </div>
                     </div>
                  </li>
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
               </ul>
               @else
               <center class="pt-3">
                  Geen Beheerder
               </center>
               @endif
            </div>

    

         </div>
      </div>


      
 


      @if($object->AllElevatorOnThisAddress)

      <div class="row ">
         <div class="col-md-12">

            <div class="card">
               <div class="card-header card-header-content-md-between  ">
                  Liften op deze locatie

               </div>
               <div class="card-body"><div class="table-responsive">
                  <table class="table  table-sm  table-hover ">
                     <thead>

                        <th scope="col">Unit No </th>
                        <th scope="col">Opmerking </th>
                        <th scope="col">Categorie </th>
                        <th scope="col">Energielabel </th>
                        <th scope="col">Nobo nr. </th>
                        <th scope="col"> </th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($object->AllElevatorOnThisAddress as $elevator_item )
                        <tr onclick="location: '/objects/show/{{$elevator_item->id}}' " style="cursor:pointer">

                           <td class="align-middle">
                              @if($elevator_item->fire_elevator)
                              <div class="cnt_table_result">

                                 <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift"
                                    class="text-danger bi bi-fire"></i>
                              </div>
                              @else
                              <div class="cnt_table_result">
                                 <i style="color: #EFEFEF" class=" bi bi-fire"></i>
                              </div>
                              @endif

                              @if($elevator_item->stretcher_elevator)
                              <div class="cnt_table_result">

                                 <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brancard / Bedlift"
                                    class="text-primary fa-solid fa-bed"></i>
                              </div>

                              @else
                              <div class="cnt_table_result">

                                 <i style="color: #EFEFEF" class=" fa-solid fa-bed"></i>
                              </div>

                              @endif

                              {{$elevator_item->unit_no}}

                           </td>
                           <td class="align-middle">
                              {{$elevator_item->remark}}
                           </td>
                           <td class="align-middle">

                              @if($elevator_item?->object_type_id)
                              <small>
                                 {{config('globalValues.object_types')[$elevator_item?->object_type_id]}}
                              </small>
                              @endif
                           </td>
                           <td class="align-middle">
                              <div class="energy-class">

                                 @if($elevator_item->energy_label=='A')

                                 <div class="a"></div>
                                 @elseif($elevator_item->energy_label=='B')
                                 <div class="b"></div>
                                 @elseif($elevator_item->energy_label=='C')
                                 <div class="c"></div>
                                 @elseif($elevator_item->energy_label=='D')
                                 <div class="d"></div>
                                 @elseif($elevator_item->energy_label=='E')
                                 <div class="e"></div>
                                 @elseif($elevator_item->energy_label=='F')
                                 <div class="f"></div>
                                 @elseif($elevator_item->energy_label=='G')
                                 <div class="g"></div>
                                 @else
                                 Onbekend
                                 @endif

                              </div>
                           </td>

                           <td class="align-middle"> {{$elevator_item->nobo_no}}</td>

                           <td class="align-middle">

                              @if($object->id == $elevator_item->id)
                              <span style="float: right" class="badge bg-soft-primary-light text-primary p-1">Deze
                                 lift</span>
                              @else
                              <a style="float: right" href="/elevator/show/{{$elevator_item->id}}">
                                 <button type="button" class="btn btn-ghost-warning btn-icon btn-sm rounded-circle">
                                    <i class="bi-eye"></i>
                                 </button>
                              </a>
                              @endif

                           </td>
                        <tr>

                           @endforeach
                     </tbody>
                  </table>
      </div>
               </div>
            </div>
         </div>
      </div>

      @endif


      @if(count($object->maintenance_contracts))
      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between ">
                  Onderhoudscontracten
                  </span>
               </div>
               <div class="card-body">
                
               <div class="table-responsive">
                  <table class="table  table-sm  table-hover " style="cursor: pointer">
                     <thead class="bg-light">
                        <tr>
                           <th scope="col">Status </th>
                           <th scope="col">Begindatum </th>
                           <th scope="col">Einddatum </th>
                           <th scope="col"> </th>
                           <th scope="col"> </th>
                           <th scope="col"> </th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach($object->maintenance_contracts as $item)

                        <tr>
                           <td class="align-middle" style="width: 120px">

                              @if(!$item->isValid)
                              <span class="badge   bg-soft-success text-success  p-2"> Geldig </span>
                              @else
                              <span class="badge   bg-soft-danger text-danger  p-2"> Verlopen </span>
                              @endif

                           </td>
                           <td class="align-middle" style="width: 120px">
                              @if($item->begindate)
                              {{ \Carbon\Carbon::parse($item->begindate)->format('d-m-Y')}}
                              @endif
                           </td>
                           <td class="align-middle" style="width: 120px">
                              @if($item->enddate)
                              {{ \Carbon\Carbon::parse($item->enddate)->format('d-m-Y')}}
                              @endif

                           </td>

                           <td class="align-middle">
                              {{$object?->maintenanceCompany?->name}}

                           </td>

                           <td class="align-middle">
                              @if($item->attachment)
                              <button class="btn btn-soft-primary btn-sm"
                                 wire:click="downloadDocument('maintenancycontract','{{$item->id}}')">
                                 <i class="fa-solid fa-paperclip"></i> Contract </button>
                              @else
                              -
                              @endif
                           </td>
                           <td>

                              <div style="float:right">
                                 <a href="/maintenance-contract/edit/{{$item->id}}">
                                    <button type="button" data-bs-toggle="modal"
                                       class="btn btn-ghost-warning btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-pencil"></i>
                                    </button>
                                 </a>
                              </div>

                           </td>

                        </tr>

                        @endforeach

                        <!--[if ENDBLOCK]><![endif]-->
                     </tbody>
                  </table>

      </div>
               </div>
            </div>
         </div>
      </div>

 
                 
        @endif


                 @if(count($object->maintenance))
      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between  ">
                  
             Onderhoudsbeurten     <a href="#maintenance"></a>
               </div>

               <div class="card-body">

               <div class="table-responsive">

                  <table class="table  table-sm  table-hover   " onclick="location " style="cursor: pointer">
                     <thead class="bg-light">
                        <tr>
                           <th scope="col">Status </th>

                           <th scope="col">Plandatum </th>
                           <th scope="col">Uitvoerdatum </th>
                           <th scope="col">Opmerking </th>
                           <th scope="col">  </th>
                           

                        </tr>
                     </thead>
                     <tbody>

                        @foreach($object->maintenance as $item)

                        <!--[if BLOCK]><![endif]-->
                        <tr>
                           <td class="align-middle" style="width: 120px">

                              <span class="badge   bg-soft-primary text-primary  p-2"> Uitgevoerd </span>

                           </td>
                           <td class="align-middle" style="width: 150px">
                              @if($item->planned_at)
                              {{ \Carbon\Carbon::parse($item->plan_date)->format('d-m-Y')}}
                              @else
                              -
                              @endif
                           </td>
                           <td class="align-middle" style="width: 150px">
                              @if($item->executed_datetime)
                              {{ \Carbon\Carbon::parse($item->executed_datetime)->format('d-m-Y')}}
                              @else
                              -
                              @endif

                           </td>

                           <td class="align-middle">
                              @if($item->remark)
                              <small>{{$item->remark}}</small>
                              @else
                              -
                              @endif
                           </td>

                           <td scope="row">
                              @if($item->attachment)
                              <button class="btn btn-ghost-primary " style = "float: right"
                                 wire:click="downloadDocument('maintenance','{{$item->id}}')">
                                 <i class="fa-solid fa-paperclip"></i> Bijlage </button>
                              @else
                              -
                              @endif
                           </td>
                         

                        </tr>

                        @endforeach

                        <!--[if ENDBLOCK]><![endif]-->
                     </tbody>
                  </table>

      </div>
               </div>
            </div>
         </div>
      </div>

      

                    

             
                  @endif

                  @if(count($object->incidents))
      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between  ">
               <a name="incidents">Storingen</a>        

               </div>
               <div class="card-body">
       
               <div class="table-responsive">
                  <table class="table  table-sm  table-hover   ">
                     <thead class="bg-light">
                        <tr>
                           <th scope="col">Prioriteit </th>
                           <th scope="col">Status</th>
                           <th scope="col">Datum / Tijd </th>
                           <th scope="col">Onderwerp </th>

                           <th scope="col"> </th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach($object->incidents as $item)

                        <!--[if BLOCK]><![endif]-->
                        <tr onclick="location='/incident/{{$item->id}}'" style="cursor: pointer">
                           <td class="align-middle" style="width: 120px">

                              @if($item->priority_id==1)
                              <span class="badge   bg-soft-danger text-danger  p-2"> Hoog </span>
                              @elseif($item->priority_id==2)
                              <span class="badge   bg-soft-warning text-warning  p-2"> Gemiddeld </span>
                              @elseif($item->priority_id==3)
                              <span class="badge   bg-soft-success text-success  p-2"> Laag </span>
                              @endif
                           </td>

                           <td class="align-middle" style="max-width: 140px">

                              @if ($item->status_id == 0)
                              <span class="text-warning py-1">Nieuw
                              </span>
                              @elseif($item->status_id == 2)
                              <span class="text-info py-1">Doorgestuurd naar
                                 onderhoudsbedrijf
                              </span>
                              @elseif($item->status_id == 99)
                              <span class="text-info py-1">Gereed
                              </span>
                              @elseif($item->status_id == 3)
                              <span class="text-info py-1">Wacht op offerte
                              </span>
                              @elseif($item->status_id == 4)
                              <span class=" text-info py-1">Offerte naar klant gestuurt
                              </span>
                              @elseif($item->status_id == 5)
                              <span class=" text-info py-1">Niet gereed
                              </span>
                              @elseif($item->status_id == 6)
                              <span class=" text-info py-1">Onjuist gemeld
                              </span>
                              @elseif($item->status_id == 7)
                              <span class=" text-info py-1">Offerte in opdracht
                              </span>
                              @elseif($item->status_id == 8)
                              <span class="text-info py-1"> Werkzaamheden gepland
                              </span>

                              @elseif($item->status_id==9)
                              <span class=" text-info"> Wachten op uitvoerdatum
                              </span>

                              @endif
                           </td>

                           <td class="align-middle" style="width: 150px">
                              {{ \Carbon\Carbon::parse($item->report_date_time)->format('d-m-Y H:m')}}
                           </td>

                           <td class="align-middle">

                              {{$item->subject}}
                              <br><small> {{$item->description}}</small>

                           </td>

                           <td class="align-middle">

                              <div style="float: right">

                             
                              </div>

                           </td>

                        </tr>

                        @endforeach

                        <!--[if ENDBLOCK]><![endif]-->
                     </tbody>
                  </table>

      </div>
               </div>
            </div>
         </div>
      </div>

 
                  @endif


                                    @if(count($object->inspections))
      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between ">
               <a name="inspections">Keuringen</a>
               </div>
               <div class="card-body">

               <div class="table-responsive">
                  <table class="table  table-sm  table-hover   " onclick="location " style="cursor: pointer">
                     <thead class="bg-light">
                        <tr>
                           <th scope="col">Status </th>
                           <th scope="col">Begindatum </th>
                           <th scope="col">Einddatum </th>
                           <th scope="col">Opmerking </th>
                           <th scope="col"> </th>
                        
                        </tr>
                     </thead>
                     <tbody>

                        @foreach($object->inspections as $item)

                        <!--[if BLOCK]><![endif]-->
                        <tr>
                           <td class="align-middle" style="width: 120px">

                              @if($item->status_id==1)
                              <span class="badge   bg-soft-success text-success  p-2"> Goedgekeurd </span>

                              @elseif($item->status_id==2)
                              <span class="badge   bg-soft-warning text-warning  p-2"> Goedgekeurd met acties
                              </span>

                              @elseif($item->status_id==3)
                              <span class="badge   bg-soft-danger text-danger  p-2"> Afgekeurd </span>

                              @elseif($item->status_id==4)
                              <span class="badge   bg-soft-primary text-primary  p-2"> Onbeslist </span>

                              @elseif($item->status_id==5)
                              <span class="badge   bg-soft-info text-info  p-2"> Niet afgerond </span>

                              @endif
                           </td>

                           <td class="align-middle" style="width: 150px">
                              {{ \Carbon\Carbon::parse($item->begindate)->format('d-m-Y')}}
                           </td>

                           <td class="align-middle" style="width: 150px">
                              {{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y')}}
                           </td>

                           <td>
                              {{$item->remark}}
                           </td>

                          
                           <td scope="row">
                           @if($item->document)
                              <button class="btn  btn-ghost-primary btn-sm btn-120" 
                                 wire:click="downloadDocument('inspection','{{$item->id}}')" style="float: right; ">
                                 <i class="fa-solid fa-paperclip"></i> Rapportage </button>
                              @endif

                              @if($item->certification)
                              <button class="btn  btn-ghost-primary  btn-sm btn-120 "
                                 wire:click="downloadDocument('certification','{{$item->id}}')"
                                 style="float: right;    ">
                                 <i class="fa-solid fa-paperclip"></i> Certificaat </button> @endif
                           </td>

                          

                        </tr>

                        @endforeach

                        <!--[if ENDBLOCK]><![endif]-->
                     </tbody>
                  </table>
      </div>
               
                  <!-- Button trigger modal -->
                  <!-- keuringen MODAL  -->

               </div>
            </div>
         </div>
      </div>
  
                  
                  @endif

                  @if($object->uploads)
      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between bg-light">
               <a name="attachments">Bijlages ( {{count($object->uploads)}} ) </a>   
                  </span>
               </div>
               <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped">
                     @foreach ($object->uploads as $item)

                     <body>
                       
                        <tr>
                           <td style="width: 20px;">
                              <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                 wire:click.prevent='deleteUpload({{ $item->id }})' class="btn btn-soft-danger ">
                                 <i class="fa-solid fa-trash"></i>
                              </button>
                           </td>
                           <td>
                              <span class="text-primary" style="cursor: pointer"
                                 wire:click="downloadUpload('{{$item->path . "/" . $item->filename}}')">
                                 {{$item->filename}} </span><br>
                              <small>Toegevoegd op:
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</small>
                           </td>
                           <td>
                              @if($item?->title) {{$item?->title}} @else @endif </td>

                           <td>
                              @if($item?->type_id)
                              {{Config::get('global.upload_elevator_types')[$item?->type_id]}}
                              @endif
                           <td>
                        </tr>
                       
                     </body>
           @endforeach
                  </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

   @endif


   </div>

 
</div>
 
<div wire:ignore.self id="add_incident_modal" class="modal fade add_incident_modal" tabindex="-1"
               role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Storing aanmelden </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        @if($object->countIncident)
                        <div class=" bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative"
                           role="alert">
                           <span class="block sm:inline">Er is een storing aangemeld op deze lift, Controleer of er geen
                              storing aangemaakt word die al aanwezig is </span>
                        </div>
                        <br> @endif
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" bg-gray-100">
                                 <div class="col-sm-12">
                                    <div class="mb-3">
                                       <label class="pb-2">Melddatum</label>
                                       <input wire:model.defer="report_date_time" class="form-control"
                                          type="datetime-local">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="mb-3">
                                       <label class="pb-2">Liftstilstand</label>
                                       <x-input.select wire:model.defer="stand_still">
                                          <option value="1">Ja </option>
                                          <option value="0">Nee </option>
                                       </x-input.select>
                                    </div>
                                 </div>
                                 <div class="mb-3">
                                    <label class="pb-2">Type storing</label>
                                    <x-input.select wire:model.defer="type_id">
                                       <option value="1">Technisch </option>
                                       <option value="2">Extern </option>
                                    </x-input.select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-8">
                              @if ($errors->any())
                              <div class="alert alert-danger" role="alert"> @foreach ($errors->all() as $error) -
                                 {{ $error }}
                                 <br> @endforeach
                              </div>
                              @endif
                              <div class="mb-3">
                                 <label class="pb-2">Onderwerp</label>
                                 <input class="form-control" wire:model.defer="subject"
                                    placeholder="Onderwerp van de storing">
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Omschrijving</label>
                                 <textarea class="form-control" rows="4" cols="50" wire:model.defer="descriptioni"
                                    placeholder="Beschrijf zo goed mogelijk de storing"></textarea>
                                 @error('descriptioni') <span class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Contactpersoon</label>
                                 <input class="form-control" rows="4" cols="50" wire:model.defer="contactperson">
                                 @error('contactperson') <span class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Telefoonnummer</label>
                                 <input wire:model.defer="contactperson_phonenumber" type="text" class="form-control"
                                    id="inlineFormInputGroupUsername">
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Adres</label>
                                 <input class="form-control" rows="4" cols="50"
                                    wire:model.defer="contactperson_address"> @error('contactperson_address') <span
                                    class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                           </div>
                        </div>
                        <div style="float: right">
                           <br>
                           <button type="button" wire:click="storeIncident()" class="btn btn-soft-primary">
                              <i class="uil uil-exclamation-triangle me-2"></i> Storing aanmelden </button>
                        </div>
                     </div>
                  </div>
                  <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>
<!-- Upload attchment modal -->
<div wire:ignore.self id="add_attachment_modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="add_attachment_modal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Bijlage toevoegen  </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class = "modal-body">
            <form wire:submit.prevent="addUpload">

            <div class="mb-3">
               <label class = "pb-2">Type</label>
               <select class="form-select @if ($errors->has('upload_type'))  is-invalid @endif" wire:model="upload_type">
                  <option value=""> Selecteer een bijlage type </option>
                  @foreach (Config::get('global.upload_elevator_types') as $key => $value)
                  <option value="{{$key}}">{{$value}}</option>
                  @endforeach
               </select>
            </div>
            <div class="mb-3">
               <label class = "pb-2">Bijlage</label>
               <input  class=" form-control " type="file"
                  wire:model="upload_filename">
            </div>


            <div class="mb-3">
               <label class = "pb-2">Titel</label>
               <input  class=" form-control " type="text"
                  wire:model="title">
            </div>
 
         </form>

         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-soft-warning" data-bs-dismiss="modal">Sluiten</button>


            <button    wire:loading.attr="disabled"  class="btn btn-soft-success    " 
         wire:click="addUpload()" type="button">
      <div wire:loading >
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      </div>
      Opslaan
      </button>


           
         </div>
      </div>
   </div>
</div>


</div>
<script>
document.addEventListener('livewire:init', () => {
      Livewire.on('close-add-attachment-modal', (event) => {
          $('#add_attachment_modal').modal('hide');
      });
   });
   
</script>