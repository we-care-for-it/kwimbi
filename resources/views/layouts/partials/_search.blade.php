<form >
                  <center>

                     <div class="row pt-3">

                        <div class="col-md-2">

                           <select class="form-select">
                              <option value="Alles">Zoek in alles</option>
                              <option value="Alles">Locaties</option>
                              <option value="Alles">Objecten</option>
                           </select>
                        </div>
                        <div class="col-md-10">

                           <div class="input-group input-group-merge w-100">
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