<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                Locatie tovoegen
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary btn-sm  btn-120" wire:click="save()">
                    Opslaan
                </button>
                <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  ">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">


          
                    @livewire('company.customers.partials.information', ['customer_id' => $customer_id])
                
                    <label>Afbeelding</label>
                    <br>        <br>
                    <div class="clear-fix"></div>
                    <span id="passwordHelpInline" class="form-text pt-4"> </span>
                    <div class="d-flex align-items-center">
                     <label class="avatar avatar-xl avatar-circle avatar-uploader me-5" for="editAvatarUploaderModal">
                            
                           @if ($image)
                         <img class="avatar-img" src="{{ $image ? $image->temporaryUrl() :  url('storage/images/'.$product_image)  }}" width="250" height="300" />
                         @else
                         <img class="avatar-img" src="/assets/img/160x160/img2.jpg"   />
                         @endif
                  
                         <input
                             type="file"
                             class="js-file-attach avatar-uploader-input"
                             id="editAvatarUploaderModal"
                             data-hs-file-attach-options='{
                                 "textTarget": "#editAvatarImgModal",
                                 "mode": "image",
                                 "targetAttr": "src",
                                 "allowTypes": [".png", ".jpeg", ".jpg"]
                              }'
                             wire:model.live="image"
                         />

                         <span class="avatar-uploader-trigger">
                             <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
                         </span>
                     </label>

                      
                     <button type="button" wire:click="clearImage()" class="js-file-attach-reset-img btn btn-white">Verwijder</button>
                 </div>
                 <label class = "pb-2 pt-3">Gebou type</label>
                 <div class="tom-select-custom tom-select-custom-with-tags">
                    <select class="js-select form-select" autocomplete="off"  
                            data-hs-tom-select-options='{
                              "placeholder": "Select a person..."
                            }'>
                      <option value="">Select a person...</option>
                      <option value="4">Thomas Edison</option>
                      <option value="1">Nikola</option>
                      <option value="3">Nikola Tesla</option>
                      <option value="5">Arnold Schwarzenegger</option>
                    </select>
                  </div>
                 
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-content-md-between  ">

                    Gebouw gegevens
                </div>

                <div class="card-body">
                    <div class = "row">
                        <div class = "col-md-12">
                           <div>
                              <label class = "pb-2">Naam</label>
                              <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                           </div>
                        </div>
                     </div>
                     <div class = "row">
                        <div class = "col-md-6">
                           <div class  = "pt-3">
                              <label class = "pb-2">Postcode</label>
                              <div class="input-group   ">
                                 <input class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif " wire:model.defer="zipcode" style = "width: 200px;">
                                 <div class="input-group-append">
                                    <button class = "btn btn-soft-primary" style = "height: 43px" wire:click = "checkZipcode"  data-toggle="tooltip" data-placement="top" title="Zoek naar postcode" wire:keydown="checkZipcode" style = "height: 40px;">
                                    <i class="bi-search"></i>
                                    </button>
                                 </div>
                                 @if ($errors->has('zipcode')) <span class="text-danger">Postcode formaat niet juist</span> @endif
                              </div>
                           </div>
                           <div class  = "pt-3">
                              <label class = "pb-2">Plaats</label>
                              <input wire:model = "place"  class  = "form-control">
                           </div>
                        </div>
                        
                        <div class = "col-md-6">
                           <div class  = "pt-3">
                              <label class = "pb-2">Adres</label>
                              <input wire:model = "address"  class  = "form-control">
                           </div>


                           <div class  = "pt-3">
                              <label class = "pb-2">Complexnummer</label>
                              <input style = "width: 200px;" wire:model = "address"  class  = "form-control">
                           </div>
                        </div>


                        
                     </div>
           
                     <div class = "row">
                        <div class = "col-md-3">
                           
                        </div>
                        <div class = "col-md-3">
                           <label class = "pb-2 pt-3">Adres</label><div class="tom-select-custom tom-select-custom-with-tags">
                              <select class="js-select form-select" autocomplete="off" multiple
                                      data-hs-tom-select-options='{
                                        "placeholder": "Select a person..."
                                      }'>
                                <option value="">Select a person...</option>
                                <option value="4">Thomas Edison</option>
                                <option value="1">Nikola</option>
                                <option value="3">Nikola Tesla</option>
                                <option value="5">Arnold Schwarzenegger</option>
                              </select>
                            </div>
                        </div>

                        <div class = "col-md-3">
                           <label class = "pb-2 pt-3">Adres</label><div class="tom-select-custom tom-select-custom-with-tags">
                              <select class="js-select form-select" autocomplete="off" multiple
                                      data-hs-tom-select-options='{
                                        "placeholder": "Select a person..."
                                      }'>
                                <option value="">Select a person...</option>
                                <option value="4">Thomas Edison</option>
                                <option value="1">Nikola</option>
                                <option value="3">Nikola Tesla</option>
                                <option value="5">Arnold Schwarzenegger</option>
                              </select>
                            </div>
                        </div>


                </div>

                <div class = "row">
                  <div class = "col-md-12">
        
                     <div class="d-flex justify-content-between">
                        <label class = "pb-2 pt-3">Notite</label>
    
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

    </div>
</div>
 