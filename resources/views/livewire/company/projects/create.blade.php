<div>
<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
            Project aanmaken
         </div>
         <div class="col-auto">
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
    


<div class="row    ">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body ">

                <label class="col-sm-3 pt-0  col-form-label">Naam</label>
                <input class="form-control @error('name') is-invalid @enderror" wire:model="name" type="text"
                    value="{{ old('name',@$project->name) }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-between">
                    <label class="col-sm-3 col-form-label">Omschrijving</label>

                    <span id="maxLengthCountCharacters" class="text-muted mt-3"></span>
                </div>
                <textarea class="js-count-characters form-control" wire:model="description" name="description" rows="4"
                    maxlength="100" data-hs-count-characters-options='{
        "output": "#maxLengthCountCharacters"
      }'>{{ old('name',@$project->description) }}</textarea>

            </div>
        </div>
    </div>
</div>

<div>
    <div class="row gy-3  pt-3 ">

        <div class="col-lg-4 col-md-6  ">
            <div class="card">
                <table class="table table-striped" style=" width 100%">
                    <tr>
                        <td class="align-middle">Begindatum</td>
                        <td class="text-end"> <input class="form-control @error('startdate') is-invalid @enderror"
                                name="startdate" type="date" value="{{ old('place',@$project->startdate) }}"
                                wire:model="startdate">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Einddatum</td>
                        <td class="text-end">
                            <input class="form-control @error('enddate') is-invalid @enderror" name="enddate"
                                type="date" value="{{ old('enddate',@$project->enddate) }}" wire:model="enddate">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Status</td>
                        <td>

                            <!-- Select -->

                            <div class="tom-select-custom">

                                <select class="js-select form-select " wire:model="status_id" name="status_id">

                                    @foreach($statuses as $status)
                                    <option value="{{$status?->id}}" @if(isset($project->status_id) && $status->id
                                        ==
                                        $project->status_id) selected @endif value="{{ $status->id }}"
                                        data-option-template='<span class="d-flex align-items-center"><span
                                                class="{{$status?->status_color}}">{{ $status->name }}</span>{{ $status->procent}}%</span>'>{{ $status->name}}
                                    </option>

                                    @endforeach

                                </select></div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="col-lg-4 col-md-6  ">
            <div class="card">
                <table class="table table-striped">
                    <tr>
                        <td class="align-middle">Relatie</td>
                        <td>

                            <div class="tom-select-custom">

                                <select class="js-select form-select " id="customer_id" name="customer_id"
                                    name="customer_id" data-hs-tom-select-options='{
                                "placeholder": "Selecteer een relatie..."
                                }'>

                                    <option value="">Geen relatie</option>
                                    @foreach($debtors as $debtor)

                                    <option @if(isset($project->customer_id) && $debtor->id ==
                                        $project->customer_id) selected @endif
                                        value="{{ $debtor->id }}">
                                        {{$debtor->name}}
                                    </option>
                                    @endforeach

                                </select>
                                @error('customer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Contactpersoon</td>
                        <td>
                            <input class="form-control @error('contact_person_name') is-invalid @enderror"
                                name="contact_person_name" type="text"
                                value="{{ old('place',@$project->contact_person_name) }}" wire:model="contact_person_name">
                            @error('contact_person_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="col-lg-4 col-md-6  ">
            <div class="card">
                <table class="table table-striped">

                    <tr>
                        <td class="align-middle">Project uren</td>
                        <td>
                            <input style="width:80px; float: right"
                                class=" form-control @error('budget_hours') is-invalid @enderror"
                                name="budget_hours" type="text"
                                value="{{ old('budget_hours',@$project->budget_hours) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>

                        <td class="align-middle">Project kosten</td>
                        <td>
                            <input style="width:80px; float: right"
                                class=" form-control @error('budget_costs') is-invalid @enderror"
                                name="budget_costs" type="text"
                                value="{{ old('budget_costs',@$project->budget_costs) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>

                </table>
            </div>
        </div>

    </div>

</div>
</div>
</div>

</div>
</div>
</div>
