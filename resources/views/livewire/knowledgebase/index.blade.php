<div>
   <div class="page-header  my-3">
      <div class="row">
         <div class="col-sm-6">
            <h1 class="page-header-title pt-2">Kennisdatabase</h1>
         </div>
      </div>
   </div>
 

    <div class = "row ">
    <div class = "col-md-12 d-flex justify-content-center align-items-center">
      <div class = "bg-light border w-100 p-5  "  >
        <center>
        <form style = "width : 80%" >
              <div class="input-group input-group-merge">
                <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                    placeholder="Zoeken op trefwoord..." data-hs-form-search-options="{
                      &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
                      &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
                      }">
                <button type="button" class="input-group-append input-group-text">
                    <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                    <i id="defaultClearIconToggleEg" class="bi-search" style="display: block; opacity: 1.03666;"></i>
                </button>
              </div>
        </form></center>
      </div>
    </div>
</div>

 
  <div class="row pt-3  gy-5 equal-cols ">
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
