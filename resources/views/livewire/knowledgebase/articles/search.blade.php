<div>
  <div class = "row pt-3">
      <div class = "col-md-12 d-flex justify-content-center align-items-center">
        <div class = "bg-light border w-100 p-5  "  >
          <center>
          <form style = "width : 80%" >
                <div class="input-group input-group-merge">
                  <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                      placeholder="Zoeken op trefwoord in de kennisdatabase..." data-hs-form-search-options="{
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
</div>
