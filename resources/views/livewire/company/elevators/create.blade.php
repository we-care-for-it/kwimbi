<div class="container-fluid">

   

    <div class="row">
       <div class="col-12">
          <div class="page-title-box d-flex align-items-center justify-content-between">
             <h4>Lift toevoegen</h4>
             <div class="page-title-right">

                
                <button type="button"  onclick="history.back()"    style = "margin-right: 10px; width:50px; " class="btn btn-primary   pr-4"><i class="fa-solid fa-angle-left"></i></button>
                
            
                <button type="button"    style = "float:right; width:120px;" wire:click="store()" class="btn btn-success   "><i class="fa-solid fa-floppy-disk"></i> Opslaan</button>
             </div>
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
                            <x-input.select  wire:model.live="customer_id" >
                                <option value="" disabled>Select klant...</option>
                                <option value="">Selecteer een klant</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                             </x-input.select>       </div>
                      </div>


                   







                </li>
                <li class="list-group-item">


                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Complex</label>
                        <div class="col-sm-6">
                            <x-input.select  wire:model.live="building_id" >
                                @if(!$customer_id)
                                <option value="">Selecteer eerst een klant</option>
                                @else
                                @endif
                                @if(count($addresses) == 0 )
                                   <option    value="">Geen complexen gevonden bij deze klant</option>
                                @else
                                   <option  value=""> {{count($addresses)}} complexen gevonden </option> 
                                @endif
                                @forelse ($addresses as $addresse)
                                    <option value="{{ $addresse->id }}">{{ $addresse->name }}, {{ $addresse->address }}, {{ $addresse->place }} , {{ $addresse->housenumber }}</option>
                                @empty
                               
                                @endforelse
                             </x-input.select>      </div>
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
                        <label for="staticEmail" class="col-sm-2 col-form-label">Bouwjaar</label>
                        <div class="col-md-2">
                            <input class="form-control col-md-2" type= "text" wire:model.live = "construction_year">                       </div>

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
                        <label for="staticEmail" class="col-sm-2 col-form-label">Fabrikant</label>
                        <div class="col-sm-4"> 
                            <input class="form-control" placeholder = "Fabrikant" type= "text" wire:model.live = "manufacture">           

                        </div>

                    </div>


                </li>


                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Onderhoudsbedrijf</label>
                        <div class="col-sm-4">      <input class="form-control" placeholder = "Onderhoudsbedrijf" type= "text" wire:model.live = "maintenance_company">           

                        </div>

                    </div>


                </li>


                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Keuringsdatum</label>
                        <div class="col-sm-2">

                            <input class="form-control" placeholder = "Controle datum" type= "date" wire:model.live = "check_date">           

                        </div>

                    </div>


                </li>


                <li class="list-group-item">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Keuring geldig tot</label>
                        <div class="col-sm-2">     <input class="form-control" placeholder = "Controle geldig tot" type= "date" wire:model.live = "check_date_valid">           

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


  
 