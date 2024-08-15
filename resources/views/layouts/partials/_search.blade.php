<form >
                  <center>

                     <div class="row  ">

                    
                        <div class="col-md-12">

                           <div class="input-group input-group-merge" style = " width:70%;">
                              <input wire:model.live="filters.keyword" type="text" wire:model.live="filters.keyword"
                                 class="js-form-search form-control" placeholder="Zoeken op trefwoord..."
                                 data-hs-form-search-options="{
 &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
 &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
 }">
                              <button type="button" class="input-group-append input-group-text">
                                 <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                                 <i id="defaultClearIconToggleEg" class="bi-search"
                                    style="display: block; opacity: 1.03666;"></i>
                              </button>
                           </div>

                        </div>

                     </div>
</center>
               </form>