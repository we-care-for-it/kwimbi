<div class="container-fluid">
    <div class="page-header     ">
        <div class="row align-items-center ">
            <div class="col">

                <h1 class="page-header-title pt-3"> {{$object->name}} </h1>
            </div>
 

            <div class="col-auto  ">

 

                <button wire:loading.attr="disabled" type="button" class="btn   btn-primary btn btn-sm btn-120" data-bs-toggle="modal"
                    data-bs-target="#crudModal">
            Wijzig
                </button>
            </div>
        </div>
    </div>

    <div class="card  p-0 m-0">
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

<div class = "card">

<div class = "card-header">Gekoppelde objecten</div>
<div class = "card-body p-2">asdasd</div>

</div>
</div>


