<div>
    <div class="container-fluid">


    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach


    <form wire:submit="save">
       <div class="page-header  my-3">
          <div class="row align-items-center">
             <div class="col">
                <h1 class="page-header-title">
             Contactpersoon toevoegen
             </div>
             <div class="col-auto">
                <a href = "/elevator/create">
                <button type="button"   class="btn btn-primary btn-sm  btn-120"  type="submit">
                Opslaan
                </button></a>
                <button type="button" onclick="history.back()"
                   class="btn btn-secondary btn-sm  ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>      
             </div>
          </div>
       </div>

       <div>
          <div class="row">
             <div class="col-md-12 pb-3">
                <label for="ernergie_label" class="pb-2 pt-2">Naam</label>
                <input type="text" wire:model = "name" class="form-control">
             </div>
          </div>
        
          <div class="row pt-3">
             <hr>
             <div class= "row">
                <div class = "col-md-4">
                  
                   <label for="ernergie_label" class="pb-2 pt-2">Status</label>
                   <div class="tom-select-custom " wire:ignore>
                      <select
                         class="js-select form-select"
                         wire:model.live ="status_id"
                         data-hs-tom-select-options='{
                         "placeholder": "Selecteer een status",
                         "hidePlaceholderOnSearch" : true,
                         "hideSearch": false,
                         "allowEmptyOption": true
                         }'
                         class="ts-wrapper js-select form-select form-select-sm tom-select-form-select-ps-0 single plugin-change_listener plugin-hs_smart_position input-hidden full has-items js-select_style"
                         id="locationLabel"
                         >
                         <option value="1" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-success"></span> <span class="text-truncate">Operationeel</span></span>'> </option>
                         <option value="2" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-danger"></span> <span class="text-truncate">Lift buiten gebruik</span></span>'> </option>
                      </select>
                   </div>
                   <label for="ernergie_label" class="pb-2 pt-2">Type</label>
                   <div class="tom-select-custom " wire:ignore>
                      <select style="height: 40px;" wire:model = "object_type_id"
                      class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een type",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'
                      @foreach(config('globalValues.object_types') as $key => $value)
                      <option 
                         value="{{ $key }}">
                         {{$value}}
                      </option>
                      @endforeach
                      </select>
                   </div>
                </div>
                <div class = "col-md-4">
                  
                </div>
                <div class = "col-md-4">
                   <label for="ernergie_label" wire:model = "remark" class="pb-2  ">Opmerking</label>
                   <textarea wire:model = "remark" class="form-control"></textarea>
                </div>
                <br>
             </div>
          </div>
        </div>
    </form>
    </div> </div>