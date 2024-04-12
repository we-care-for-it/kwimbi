<div>
   <div class="page-header  my-3">


   <div class="row ">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Kennisdatabase categories</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">
                <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success   btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Toevoegen
                </button> <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>


    @include('livewire.knowledgebase.articles.search')



   <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 pt-3 " wire:loading.remove>
  
        @foreach($groups as $letter => $group)
        <div class="col mb-3 mb-lg-5">
         <div class="card h-80 card-hover">
            <div class = "card-header">{{ $letter }}</div>
     
 <div class  = "card-body"><ul>
    @foreach($group as $category)


    <li class="list-inline-item d-inline-flex align-items-center">
                  <span class="legend-indicator bg-secondary"></span>
                  <a href = "/knowledgebase/categorie/{{$category->id}}">{{ $category['name'] }}</a>
               </li>


   

    @endforeach</ul>
    </div>
</div>
</div>

@endforeach

   </div> 

</div>


