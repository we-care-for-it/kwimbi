<div>
   <div class="page-header  my-3">
      <div class="row">
         <div class="col-sm-6">
            <h1 class="page-header-title pt-2">Kennisdatabase</h1>
         </div>
      </div>
   </div>

  @include('livewire.knowledgebase.articles.search')


  <div class="loading" wire:loading>
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
    <span class="legend-indicator bg-secondary"></span>    <a href = "">     {{$article?->title}}</a>
  </li>


                </div>
              @endforeach
            </div>
          </div>
        </div>
      @endif


    @endforeach
  </div>
@else


@include('layouts.partials._empty')
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
