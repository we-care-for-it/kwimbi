<div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">{{$article->title}}</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">    <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success   btn-120" data-bs-toggle="modal"
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


</div>
