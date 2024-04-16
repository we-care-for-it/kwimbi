<div>
   <div class="page-header  my-3">


   <div class="row ">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Kennisdatabase categories</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">
            <a href = "/knowledgebase/categories">
            <button type="button"  class="  btn btn-link     ">
                Alle categorieën 
                </button></a>


                <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success   btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Toevoegen
                </button> 
                
          
                
                
                
                <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">



                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>


 
   
@include('livewire.knowledgebase.articles.search')
<div class="loading" wire:loading pt-0>
   @include('layouts.partials._loading')
</div>
@if(count($categories))
<div class="row pt-3  gy-5 equal-cols  wire:loading.remove ">
   @foreach($categories as $categorie)
   @if(count($categorie->articles) )
   <div class = "col-md-4">
      <div class = "card   ">
         <div class = "card-header">{{$categorie->name}}</div>
         <div class = "card-body p-2 h-80">
            @foreach($categorie->articles->slice(0, 10) as $article)
            <div class = "p-2 clear-fix border-bottom">
               <li class="list-inline-item d-inline-flex align-items-center">
                  <span class="legend-indicator bg-secondary"></span>
                  <a href = "/knowledgebase/article/{{$article->slug}}">   {{ \Illuminate\Support\Str::limit($article?->title, 50, $end='...') }}
                  </a>
               </li>
            </div>
                @endforeach
         </div>


         <div class = "p-2 text-end">
                <a href = "/knowledgebase/categorie/{{$categorie->slug}}">Meer {{$categorie->name}}....</a>
                </a>

             </div>
      </div>
    </div>
      @endif
      @endforeach
   </div>
   @else
   <div class="pt-2">
      <div class="  text-center">
         <center>
            <img style = "height: 200px;"  src="/assets/img/folders/1.svg"  >
         </center>
         <div class=" ">
            <h4>Geen gegevens gevonden</h4>
            <p>Er zijn geen categorieën gevonden met artikelen</p>
         </div>
      </div>
      <div class="notice-listBlock bg-light mt-30 p-4">
         <h3>Wat kan je hier aan doen ?</h3>
         <ul >
            <li>
               Voeg gegevens toe
            </li>
         </ul>
      </div>
   </div>
   @endif
   <style>
      .row.equal-cols {
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      }
      .row.equal-cols:before,
      .row.equal-cols:after {
      display: block;
      }
      .row.equal-cols > [class*='col-'] {
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-direction: column;
      -ms-flex-direction: column;
      flex-direction: column;
      }
      .row.equal-cols > [class*='col-'] > * {
      -webkit-flex: 1 1 auto;
      -ms-flex: 1 1 auto;
      flex: 1 1 auto;
      }
   </style>
</div>
