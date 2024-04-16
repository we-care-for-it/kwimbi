<div>
  

 <!-- CrudModal  -->

 <div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body" wire:loading.class="loading-div">
               <div class="row">
                  <div class="col-md-12">
                     <div>
                        <label class="pb-2">Naam</label>
                        <input wire:model="data.name" class="form-control    @error('name') is-invalid   @enderror  ">
                        @error('data.name') <span class="invalid-feedback">ssssssss</span> @enderror
                     </div>
                  </div>
               </div>
               <div class="row pt-3">
                  <div class="col-md-6">
                     <div class="pt-3"> 
                        <label class="pb-2">Postcode</label>
                        <div class="input-group  ">
                           <input class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif "
                              wire:model="data.zipcode">
                           <div class="input-group-append">
                              <button class="btn btn-soft-primary" style="height: 43px" wire:click="checkZipcode"
                                 data-toggle="tooltip" data-placement="top" title="Zoek naar postcode"
                                 wire:keydown="checkZipcode" style="height: 40px;">
                              <i class="bi-search"></i>
                              </button>
                           </div>
                           @if ($errors->has('zipcode')) <span class="text-danger">Postcode formaat niet juist</span>
                           @endif
                        </div>
                     </div>
                     <div class="pt-3">
                        <label class="pb-2">Plaats</label>
                        <input wire:model="data.place" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="pt-3">
                        <label class="pb-2">Adres</label>
                        <input wire:model="data.address" class="form-control    @error('address') is-invalid   @enderror  ">
                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>

               <div class = "row">

               <div class="col-md-6">
                     <div class="pt-3">
                        <label class="pb-2">Emailaddres</label>
                        <input wire:model="data.emailaddress" class="form-control    @error('address') is-invalid   @enderror  ">
                        @error('emailaddress') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="pt-3">
                        <label class="pb-2">Telefoonnummer</label>
                        <input wire:model="data.phonenumber" class="form-control    @error('address') is-invalid   @enderror  ">
                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
 
            </div>
            <div class="modal-footer">
               @if($edit_id)
               <button wire:click="delete({{$edit_id}})"
                  wire:confirm.prompt="Weet je zeker dat je de dit adres wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"
                  type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3"
                  data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fa-solid fa-trash"></i>
               </button>
               @endif
               <button type="button" class="btn btn-white btn-120" data-bs-dismiss="modal">Sluiten</button>
               <button class="btn btn-soft-success btn-120    " wire:click="save()" type="button">
                  <div wire:loading wire:target="save">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('close-crud-modal', (event) => {
         $('#crudModal').modal('hide');
      });
   });
</script>

</div>
