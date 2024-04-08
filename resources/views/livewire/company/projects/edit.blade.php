<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                  Wijzig project
            </div>
            <div class="col-auto">
                      <button type="button" onclick="history.back()" class=" btn   btn-link btn-120" ">
            Afbreken
                </button>   <button type="button" class="btn btn-soft-success btn-120" wire:click="save()">
                    Opslaan
                </button>
       
            </div>
        </div>
    </div>
    <div class="row pt-0">

        <div class="col-md-3">         
            

        <div class = "card  ">        <div class="card-header      ">

Gegevens
</div>
        <div class = "card-body p2">
        <label class="pb-2  ">Begindatum</label>
        <input class="form-control @error('startdate') is-invalid @enderror" name="startdate" type="date"
            value="{{ old('place',@$project->startdate) }}" wire:model="startdate">

        <label class="pb-2 pt-3">Einddatum</label>
        <input class="form-control @error('enddate') is-invalid @enderror" name="enddate" type="date"
            value="{{ old('enddate',@$project->enddate) }}" wire:model="enddate">

        <label class="pb-2 pt-3">Status</label>
        <div class="tom-select-custom" wire:ignore>
            <select class="js-select form-select " wire:model="status_id" name="status_id">
                @foreach($statuses as $status)
                <option value="{{$status?->id}}" data-option-template='<span class="d-flex align-items-center"><span
                                    class="{{$status?->status_color}}">{{ $status->name }} </span> 
                                    
                                    
                                  - {{ $status->procent}}% </span>'>{{ $status->name}}
                </option>
                @endforeach
            </select></div>



            </div> </div>
        </div>

        <div class="col-md-9">


            <div class="card">
                 <div class="card-header      ">

Gegevens
</div>

                <div class="card-body">
 
 

            <label class="col-sm-3 pt-0  col-form-label">Naam</label>
            <input class="form-control @error('name') is-invalid @enderror" wire:model="name" type="text"
                >
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            

            <!-- Form -->
<!-- Form -->
<div class="d-flex justify-content-between pt-3">
  <label for="reviewLabelModalEg" class="form-label">Omschrijving</label>

  <span id="maxLengthCountCharacters" class="text-muted"></span>
</div>
<textarea  wire:model = "description" class="js-count-characters form-control" id="reviewLabelModalEg" placeholder="Textarea field" rows="4" maxlength="100"
          data-hs-count-characters-options='{
            "output": "#maxLengthCountCharacters"
          }'>As always, all Htmlstream products are excellent with a very good personalization.</textarea>
<!-- End Form -->


           
            


<div class = "row">

<div class = "col-md-4"><label class=" col-form-label">Contactpersoon</label>
<input class="form-control @error('contact_person_name') is-invalid @enderror"
                            name="contact_person_name" type="text"
                            value="{{ old('place',@$project->contact_person_name) }}"
                            wire:model="contact_person_name">
                        @error('contact_person_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
</div>


<div class = "col-md-2">
<label class=" col-form-label">Uren</label>
<input   wire:model = "budget_hours"     
                            class=" form-control @error('budget_hours') is-invalid @enderror"
                            name="budget_hours" type="text"
                            value="{{ old('budget_hours',@$project->budget_hours) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
</div>
<div class = "col-md-2">
<label class=" col-form-label">Kosten</label>
<input                 wire:model = "budget_costs"                   class=" form-control @error('budget_costs') is-invalid @enderror"
                            name="budget_costs" type="text"
                            value="{{ old('budget_costs',@$project->budget_costs) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror</div>

</div>

 

</div>

                </div>
            </div>
        </div>

    </div>
</div>
 