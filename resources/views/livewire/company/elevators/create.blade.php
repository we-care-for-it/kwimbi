<div class="container-fluid">

<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <img src="/assets/img/ico/users.png" class = "pageico">
            <h1 class="page-header-title"> Liften toevoegen </h1>
            </div>
         <div class="col-auto">
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary" >
            Terug
            </button>
           
            <button type="button"   wire:click="store()"  style=" width: 150px; " class="btn btn-soft-success" >
            Toevoegen
            </button></a>
         </div>
      </div>
   </div>
    <input wire:model.live = "elevator_id" type = "hidden">
    <div class="row">
        <div class="col-12">
    <div class="card">
        <div class="card-body">

            
            @if ($errors->any())

            <div class="alert alert-danger"  role="alert">
                
                    @foreach ($errors->all() as $error)
            
            
                          - {{ $error }}<br>
                                             @endforeach
              
                 </div>
          
        
        
          
        @endif




            <ul class="list-group list-group-flush">

 



                <li class="list-group-item">


                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Klant</label>
                        <div class="col-sm-6">
                        <div class="tom-select-custom " wire:ignore >
                        <select class="js-select form-select " wire:model.live="customer_id"  data-hs-tom-select-options='{
                        "placeholder": "Kies een relatie"
                        }'>

 
                                <option value="" disabled>Select klant...</option>
                                <option value="">Selecteer een klant</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach

                    </select>
                    </div>      </div>
                      </div>


                   







                </li>
                <li class="list-group-item">


                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Complex</label>
                        <div class="col-sm-6">


                        <div class="tom-select-custom " wire:ignore >
                        <select class="js-select form-select " wire:model.live="address_id"  data-hs-tom-select-options='{
                        "placeholder": "Kies een complex"
                        }'>

                        @if(!$customer_id)
                                <option value="">Selecteer eerst een klant</option>
                                @else
                                @endif
                               
                                <option value="">Selecteer een klant</option>
                                @if(count($addresses) == 0 )
                                   <option    value="">Geen complexen gevonden bij deze klant</option>
                                @else
                                   <option  value=""> {{count($addresses)}} complexen gevonden </option> 
                                @endif
                                @forelse ($addresses as $addresse)
                                    <option value="{{ $addresse->id }}">{{ $addresse->address }}, {{ $addresse->place }} , {{ $addresse->housenumber }} - {{ $addresse->name }}</option>
                                @empty
                               
                                @endforelse

                    </select>
                    </div>


      </div>
                      </div>



                    





                </li>

                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Omschrijving</label>
                        <div class="col-md-6">
                            <input class="form-control  " type= "text" wire:model.live = "description">                       </div>

                    </div>


                </li>


   
               

                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-md-2 col-form-label">Unit nr. <span class="text-danger">*</span> / nobo nr. </label>
                        <div class="col-md-2">
                            <input class="form-control " type= "text" placeholder = "Unit nummer"  wire:model.live = "unit_no">       

                        </div>
                        <div class="col-md-2">
                            <input class="form-control" placeholder = "nobo nummer" type= "text" wire:model.live = "nobo_no">           

                        </div>
                    </div>


                </li>


     

 


              


                
                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Opmerking:</label>
                        <div class="col-sm-10">     <textarea class="form-control" style="min-width: 100%; height: 200px"   placeholder = "Opmerking" type= "text" wire:model.live = "remark"> </textarea >

                        </div>

                    </div>


                </li>



              </ul>

        </div>

    </div>
</div>


  
 