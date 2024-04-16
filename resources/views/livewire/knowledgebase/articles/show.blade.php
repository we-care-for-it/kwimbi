<div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">{{$article->title}}</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">
                <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success   btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Wijzig
                </button> <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>


   </div>


   <div class="row ">
      <div class="col-md-3">
         <div class="card  ">
         <div class="card-header  ">Gegevens
</div>

<div class="card-body  ">


  <label class="pb-2">Auteur</label>
  <div class="clear-fix"></div>
{{$article->user->name}}
<br>
<small>{{$article->user->email}}</small>

 <div class="clear-fix"></div>

  <label class="pb-2  pt-3 ">Gemaakt op</label>
  <div class="clear-fix"></div>

      {{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i')}}


 <div class="clear-fix"></div>

<label class="pb-2 pt-3 ">Gewijzigd op:</label>
<div class="clear-fix"></div>

@if($article->updated_at)
{{ \Carbon\Carbon::parse($article->created_at)->format('d-m-Y H:i')}}

@else
-
@endif

<div class="clear-fix"></div>

<label class="pb-2  pt-3 ">Categorie:</label>
<div class="clear-fix"></div>

<a href = "/knowledgebase/article/category/{{$article->category->id}}">{{$article->category->name}}</a>
</a>


<div class="clear-fix"></div>
</div>
</div>
</div>
<div class="col-md-9">
   <div class="card  ">
   <div class="card-header  ">Artikel
</div>

<div class = "card-body">

 
{!! nl2br(e($article->article)) !!}

</div>
</div>
</div>

</div>





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
                        <label class="pb-2">Title</label>
                        <input wire:model="title" class="form-control    @error('name') is-invalid   @enderror  ">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
               

               <label class="form-label font-weight-bold">Job Description</label>
    <div id="quill-editor" class="mb-3" style="height: 300px;">
    </div>
   <textarea rows="3" class="mb-3 d-none" name="description" id="quill-editor-area"></textarea>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('quill-editor-area')) {
            var editor = new Quill('#quill-editor', {
                theme: 'snow'
            });
            var quillEditor = document.getElementById('quill-editor-area');
            editor.on('text-change', function() {
                quillEditor.value = editor.root.innerHTML;
            });

            quillEditor.addEventListener('input', function() {
                editor.root.innerHTML = quillEditor.value;
            });
        }
    });
</script>          </div>
            <div class="modal-footer">
         
               <button wire:click="delete({{$edit_id}})"
                  wire:confirm.prompt="Weet je zeker dat je de dit adres wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"
                  type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3"
                  data-bs-toggle="dropdown" aria-expanded="false">
               <i class="fa-solid fa-trash"></i>
               </button>
           
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


</div>
