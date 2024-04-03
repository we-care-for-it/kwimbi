<div class="container-fluid">
   <div class="page-header  ">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
            #{{sprintf('%06d', $incident->id)}} | {{$incident->subject}} 
</h1>
 
           
         Gemeld op:
         {{ \Carbon\Carbon::parse($incident->report_date_time)->format('d-m-Y')}} om
         {{ \Carbon\Carbon::parse($incident->report_date_time)->format('H:i')}}
       
       
         </div>

         <div class="col-auto">

         @if ($incident->status_id == 0)
         <span class="badge bg-soft-primary text-primary py-2">Nieuw
         </span>
         @elseif($incident->status_id == 2)
         <span class="badge bg-soft-primary text-primary  py-2">Doorgestuurd naar
         onderhoudsbedrijf
         </span>
         @elseif($incident->status_id == 99)
         <span class="badge bg-soft-primary text-primary py-2">Gereed
         </span>
         @elseif($incident->status_id == 3)
         <span class="badge bg-soft-primary text-primary py-2">Wacht op offerte
         </span>
         @elseif($incident->status_id == 4)
         <span class="badge bg-soft-primary text-primary py-2">Offerte naar klant gestuurd
         </span>
         @elseif($incident->status_id == 5)
         <span class="badge bg-soft-primary text-primary py-2">Niet gereed
         </span>
         @elseif($incident->status_id == 6)
         <span class="badge bg-soft-primary text-primary py-2">Onjuist gemeld
         </span>
         @elseif($incident->status_id == 7)
         <span class="badge bg-soft-primary text-primary py-2">Offerte in opdracht
         </span>
         @elseif($incident->status_id == 8)
         <span class="badge bg-soft-primary text-primary py-2"> Werkzaamheden gepland
         </span>
         @elseif($incident->status_id == 9)
         <span class="badge bg-soft-primary text-primary py-2"> Wachten op uitvoerdatum
         </span>
         @endif
<a href = "/incidents">
         <button type="button"  class="btn   btn-link btn-sm">
               Alle storingen
            </button>
</a>


            <button type="button" onclick="history.back()" class="btn   btn-link btn-sm">
               Terug
            </button>

         </div>

      </div>
   </div>

 
@if($incident->stand_still)
<div class="row">
   <div class="col-md-12">
      <div class="alert alert-soft-danger fade show" role="alert">
         <i class="uil uil-exclamation-octagon me-2">
         </i>
         Door deze storing is de lift buitenbedrijf
      </div>
   </div>
</div>
@endif
@if($incident->status_id==99 || $incident->status_id==6 )
<div>
<div class="alert alert-soft-warning   mb-2  " role="alert">
      <p class="mb-0"><b>Incident gesloten</b> Dit incident is gemakeerd als
         @if($incident->status_id==6)
         <b> onjuist gemeld</b>
         @endif
         @if($incident->status_id==99)
         <b> gereed </b>
         @endif
         , Reacties op dit incident is niet meer mogelijk. Maak indien nodig een andere incident aan.
      </p>
   </div>
</div>

@endif
<div class="row">
<div class="col-md-3">    <div class="card-header card-header-content-md-between ">
         Informatie
      </div>
   <div class="card">
  
      <div class="card-body">
         <ul class="list-unstyled mb-0">
            <li class="pb-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Klantnaam
                     </h5>
                     {{$incident->elevator?->address?->customer?->name}}
                  </div>
               </div>
            </li>
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Liftadres
                     </h5>
                     {{$incident->elevator?->address?->name}}
                     <br>
                     <small>
                     {{$incident->elevator?->address?->zipcode}},
                     {{$incident->elevator?->address?->place}}
                     </small>
                     <br> <br>
                     <div
                        style="  float: right;  padding-top: 10px; width: 100%">
                        <a href="/elevator/show/{{$incident->elevator_id}}">
                        Toon lift gegevens
                        </a>
                     </div>
                  </div>
            </li>
            @if($incident->elevator?->name)
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Liftnaam
            </h5>
            {{$incident->elevator?->name}}
            </div>
            </div>
            </li>
            @endif
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Unit no
            </h5>
            {{$incident->elevator?->unit_no}}
            </div>
            </div>
            </li>
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Nobo no
            </h5>
            {{$incident->elevator?->nobo_no}}
            </div>
            </div>
            </li>
            @if($incident->elevator?->name)
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Leverancier no
            </h5>
            {{$incident->elevator?->manufacture}}
            </div>
            </div>
            </li>
            @endif
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Bouwjaar
            </h5>
            @if($incident->elevator?->construction_year)
            {{$incident->elevator?->construction_year}}
            @else
            Nier opgegeven
            @endif
            </div>
            </div>
            </li>
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Contactpersoon
            </h5>
            @if($incident->contactperson)
            Geen
            @else
           -
          
            @if($incident->contactperson_address) {{$incident->contactperson_address}}
            <br> @endif
            @if($incident->contactperson_phonenumber) {{$incident->contactperson_phonenumber}}
            <br> @endif
            @endif
            </div>
            </li>
           
            <li class="py-3">
            <div class="d-flex align-items-center">
            <div class="flex-grow-1">
            <h5 class="mb-0 font-size-14">Beheerder
            </h5>

            @if($incident?->elevator?->address?->management?->name)
            {{$incident?->elevator?->address?->management?->name}}
            @else
           -
            @endif
            </div>
            </div>
            </li>
         </ul>
         </div>
         </div>
    
      </div>
      <div class="col-md-9">
         <div>
         </div>

         <div class="card-header card-header-content-md-between t">
               {{$incident->subject}}     @if($editMode)
               <div>Bewerk modes</div>
               @else
               
               @endif
            </div>

         <div class="card">
        
            <div class="card-body">           
          
               <div class="row">
                  <div class="col-md-2" style="border-right: 1px solid #EFEFEF">
                     <center>
                        <img class="rounded-circle " style="height: 70px"
                           src="{{  asset('assets/img/avatar.jpg') }}">
                        <div style="padding-top:10px;">
                           {{$incident?->reporter?->name}}
                           @if (str_contains($incident?->reporter?->email, ''))
                           <div class="clear-fix pt-2">
                           </div>
                           <p class="m-0 badge rounded-pill bg-soft-primary text-primary  py-2 mt-2  ">Medewerker
                           </p>
                           @endif
                        </div>
                        @if(!$editMode)
                        <div class = "pt-3">
                            <button type="button" wire:click="$set('editMode', true)"   class="btn btn-ghost-warning btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-pencil"></i>  
                            </button>

                            <button  wire:click="deleteIncident({{$incident->id}})"  wire:confirm.prompt="Weet je zeker dat je dit incident wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD"  type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-trash"></i>  
                            </button>      
                            </div>
                        @endif
                     </center>
                  </div>
                  <div class="col-md-10 ">
                     @if($editMode)
                     <textarea class="form-control" wire:model="description"
                        style="width: 100%;  height: 118px; background-color:  #fcfcf7">
                    {{$incident->description}}</textarea>
                     @if($editMode)
                     <button type="button" wire:click="saveIncident()" style="float: right"
                        class="btn btn-soft-primary   btn-sm mt-2  ">
                     <i class="fa-solid fa-save">
                     </i> Opslaan
                     </button>
                     <button type="button" wire:click="$set('editMode', false)"
                        style="float: right; margin-right: 3px" class="btn btn-soft-warning  btn-sm mt-2    ">
                     Sluiten
                     </button>
                     @endif
                     @else
                     {{$description}}
                     @endif
                     <div style="position: absolute; bottom: 5px;  ">
                        @if($editMode)
                        <input wire:model.defer="report_date_time" class="form-control"
                           type="datetime-local">
                        @else
                        <div class = "py-3">
                        <small>
                        Gemeld op:
                        {{ \Carbon\Carbon::parse($incident->report_date_time)->format('d-m-Y')}} om
                        {{ \Carbon\Carbon::parse($incident->report_date_time)->format('H:i')}}
                        </small>
                        /
                      
                        <small style = "color: #8495a9; " > Aangemaakt op: {{ \Carbon\Carbon::parse($incident->created_at)->format('d-m-Y')}} om
                        {{ \Carbon\Carbon::parse($incident->created_at)->format('H:i')}} </small>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-3">
            <div class="col-md-2">
            </div>
            <div class="col-md-10">
               <div class="card ">
                  <div class="card-header card-header-content-md-between bg-light">
                     Geef reactie
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-3" style="border-right: 1px solid #EFEFEF">
                           <center>
                              <img class="rounded-circle " style="height: 70px"
                                 src="{{  asset('/assets/img/avatar.jpg') }}">
                              <div style="padding-top:10px;">
                                 {{ Auth::user()->name }}
                              </div>
                              <div class="clear-fix">
                              </div>
                              <small>{{ Auth::user()->email }}
                              </small>
                           </center>
                        </div>
                        <div class="col-md-8">
                           <textarea class="form-control mb-3" wire:model.defer="replyMessage"
                              style="background-color: #F7F4CF">
                     </textarea>
                           @error('replyMessage')
                           <span class="invalid-feedback">Vul een reactie in
                           </span> @enderror
                           <button wire:click="addIncidentReply()" class="btn btn-soft-success"
                              style="float: right">Reactie toevoegen
                           </button>
                           <div class="row">
                              <div class="col-md-5">
                                 <select class="form-select" wire:model.defer="replyStatus">
                                    <option value="{{$incident->status_id}}" selected>Status...
                                    </option>
                                    <option value="2">Doorgestuurd naar onderhoudsbedrijf
                                    </option>
                                    <option value="3">Wacht op offerte
                                    </option>
                                    <option value="4">Offerte naar klant
                                    </option>
                                    <option value="5">Niet gereed
                                    </option>
                                    <option value="6">Onjuist gemeld
                                    </option>
                                    <option value="7"> Offerte in opdracht
                                    </option>
                                    <option value="8"> Werkzaamheden gepland
                                    </option>
                                    <option value="9"> Wachten op uitvoerdatum
                                    </option>
                                    <option value="99">Gereed
                                    </option>
                                 </select>
                              </div>
                              <div class="col-md-5">
                                 <input type="datetime-local" style="margin-left: 10px; "
                                    class="form-control" wire:model="replyDate">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @foreach($incident->replys as $reply)
         <hr>
         <div class="card" @if($reply->status_id==99 || $reply->status_id==6) style = "background-color: #DCF6E8"
         @endif >
         <div class="card-body">
            <div class="row">
               <div class="col-md-3" style="border-right: 1px solid #EFEFEF">
                  <center>
                     <img class="rounded-circle " style="height: 70px"
                        src="{{  asset('assets/img/avatar.jpg') }}">      
                     <div style="padding-top:10px; padding-bottom:10px;">
                        {{$reply?->user?->name}}
                     </div>
                     <div class="clear-fix">
                     </div>
                     @if($reply->status_id==0)
                     <span class="badge rounded-pill bg-soft-warning text-warning p-2">Geen status
                     </span>
                     @elseif($reply->status_id==2)
                     <span class="badge rounded-pill bg-soft-success  text-success p-2">Doorgestuurd naar onderhoudsbedrijf
                     </span>
                     @elseif($reply->status_id==3)
                     <span class="badge rounded-pill bg-soft-info text-info p-2">Wacht op offerte
                     </span>
                     @elseif($reply->status_id==4)
                     <span class="badge rounded-pill bg-soft-primary text-primary p-2">Offerte naar klant gestuurd
                     </span>
                     @elseif($reply->status_id==5)
                     <span class="badge rounded-pill bg-soft-primary text-primary p-2">Niet gereed
                     </span>
                     @elseif($reply->status_id==9)
                     <span class="badge rounded-pill bg-soft-primary text-primary p-2">  Wachten op uitvoerdatum
                     </span>
                     @elseif($reply->status_id==99)
                     <span class="badge rounded-pill bg-success p-2">Lift weer in bedrijf
                     </span>
                     @endif
                  </center>
               </div>
               <div class="col-md-9 ">
                  <div style = "float: right" class =  "float-right; pb-2" >
                     <span wire:click = "deleteReply({{$reply->id}})"   style = "cursor: pointer" wire:confirm.prompt="Weet je zeker dat je deze reactie wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD" class="text-danger">
                     <i class="fa-solid fa-trash"></i>  
                     </span>
                  </div>
                  {!! nl2br(e($reply->message)) !!}
                  <div style="position: absolute; bottom: 2px;  " class = "py-3">
                     <small>
                        Geplaatst op:
                     {{ \Carbon\Carbon::parse($reply->created_at)->format('d-m-Y')}} om
                     {{ \Carbon\Carbon::parse($reply->created_at)->format('H:i')}}
                     </small>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>


<div wire:ignore class="modal fade" id="uploadAttachment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Bestand toevoegen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="mb-3">
               <label class = "pb-2">Naam</label>
               <br>
               <input class="form-control @if ($errors->has('title'))  is-invalid @endif  " type="text"
                  wire:model.defer="title">
            </div>
            <div class="mb-3">
               <label class = "pb-2">Type bijlage</label>
               <select class="form-select" wire:model="upload_type">
                  @foreach (Config::get('global.upload_incident_types') as $key => $value))
                  <option value="{{$key}}"> {{$value}}
                  </option>
                  @endforeach
               </select>
            </div>
            <div class="mb-3">
               <label class = "pb-2">Bijlage</label>
               <input  accept="application/pdf" class=" form-control @if ($errors->has('upload_filename'))  is-invalid @endif  " type="file"
                  wire:model="upload_filename">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-ghost-secondary" data-bs-dismiss="modal">Sluiten</button>
            <button type="button"  class="btn btn-soft-success " wire:click="addUpload()">Upload bijlage
            </button>
         </div>
      </div>
   </div>
</div>