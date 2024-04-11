<div>
    <div class="page-header  my-3">
    <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">{{$object?->name}}</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end"> <button wire:loading.attr="disabled" type="button" class="btn    btn-link     " data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Wijzig
                </button>
                <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>
    </div>
 





    <div class="card  ">
        <div class="card-body ">

            <div class="row ">

                <div class="col-md-3">
                    <label class="form-label ">Naam</label>
                    <p>{{$object->name}}</p>

                    <label class="form-label pt-2 ">Adres</label>
                    <p>{{$object->address}} {{$object->zipcode}} {{$object->place}}</p>

               
                </div>

                <div class="col-md-3">
                    <label class="form-label ">Telefoonnummer</label>
                    <p>@if($object->phonenumber) {{$object->phonenumber}} @else - @endif</p>

                    <label class="form-label pt-2 ">Emailadres</label>
                    <p>@if($object->emailaddress) {{$object->emailaddress}} @else - @endif</p>
                </div>

            </div>
        </div>
 

        @livewire('company.suppliers.crudmodal', ['object' => $object])

<div class = "card mt-3">

<div class = "card-header">Gekoppelde objecten</div>
<div class = "card-body p-2">Functie nog niet beschikbaar</div>

</div>
</div>


 
  