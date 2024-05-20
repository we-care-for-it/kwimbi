<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
       Keuring bekijken
         </div>
         <div class="col-auto">

         <button wire:click="delete()" wire:confirm.prompt="Weet je zeker dat je deze onderhoudsbeurt witl verwijderen ?\n\nType AKKOORD voor bevestiging |AKKOORD" type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash"></i>
               </button>


            <button type="button"     class="btn btn-primary btn-sm  btn-120" wire:click="save()">
            Opslaan
            </button>
            <button type="button" onclick="history.back()"
               class="btn btn-secondary btn-sm  ">
            <i class="fa-solid fa-arrow-left"></i>
            </button>
         </div>
      </div>
   </div>
   <div class="row">



   
   <div class="col-md-3">
       
            @livewire('company.elevators.partials.information', ['elevator' => $elevator])
 
                </div>

                
        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-content-md-between  ">

              Keuring gegevens
                </div>

                <div class = "card-body">
                <div class="row">
      <div class="col-md-2">
      <label class = "mb-2"> Uitvoeringsdatum </label>
      <br>
      <input wire:model = "inspection_executed_datetime" class=" @if ($errors->has('inspection_executed_datetime'))  is-invalid @endif form-control" type="date">
      </div>
      <div class="col-md-4">
      <div style = "padding-top: 30px;">
      <button type="button" class="btn btn-soft-primary" wire:click = "addMonthsInspection(12)" > + 1 jaar </button>
      <button type="button" class="btn btn-soft-primary"   wire:click = "addMonthsInspection(18)"> + 1,5 jaar </button>
      </div>
      </div>
      <div class="col-md-2">
      <label class = "mb-2"> Einddatum </label>
      <br>
      <input wire:model = "inspection_end_date" class=" @if ($errors->has('inspection_end_date'))  is-invalid @endif form-control" type="date">
      </div>
      </div>
      <br>
      <div class="row">
      <div class="col-md-6">
      <label class = "mb-2"> Status </label>
      <br>
      <select wire:model = "inspection_status_id" class="form-select">
      <option selected value="1" >Goedgekeurd</option>
      <option value="2">Goedgekeurd met acties</option>
      <option value="3">Afgekeurd</option>
      <option value="4">Onbeslist</option>
      <option value="5">Niet afgerond</option>
      </select>
      </div>
      <div class="col-md-6">
      <label class = "mb-2"> Opmerking </label>
      <br>
      <textarea wire:model = "inspection_remark" class="form-control"></textarea>
      <br><br>
      </div>
      <div class="row   p-2" >
      <div class="col-md-6">
      <label class = "mb-2">Keuringsrapportage</label>
      <div wire:loading>
      </div>
      @if($attachmentDocument)
      <br>
    
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="delete_temp_document()"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('attachmentDocument'))  is-invalid @endif form-control " type="file" wire:model="attachmentDocument">
      @endif


      </div>
      <div class="col-md-6 ">
      <label  class = "mb-2" >Certificaat</label>


      @if($attachmentCertification)
      <br>
    
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="delete_temp_certification()"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('attachmentCertification'))  is-invalid @endif form-control " type="file" wire:model="attachmentCertification">
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
                           <div class="col-md-9">
                              <textarea class="form-control mb-3" wire:model.defer="replyMessage"
                                 style="background-color: #F7F4CF">
                        </textarea>
   
                        <div class = "bg-light p-2">
                        <div class="row">
  <div class="col-sm-6"> 
    
  
  <select class="form-select" wire:model.defer="replyStatus">
                                 <option value="{{$inspection->status_id}}" selected>Status...
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
                     
                                


                              </select> </div>  
  <div class="col-sm-6">
    
      <button wire:click="addinspectionReply()" class="btn btn-soft-success"
                                 >Reactie toevoegen
                              </button></div>  
</div> 

                          

                              @error('replyMessage')
                              <span class="invalid-feedback">Vul een reactie in
                              </span> @enderror
                         
                               
 
   
    
                                 </div>
                             
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @foreach($inspection->replys as $reply)
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

                
            </div>



</div> 