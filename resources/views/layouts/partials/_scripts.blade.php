 
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script> 
  <script src="/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script src="/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></script>
  <script src="/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>
  <script src="/assets/js/theme.min.js"></script>
  <script src="/assets/vendor/dropzone/dist/min/dropzone.min.js"></script>
  <script src="/assets/vendor/hs-count-characters/dist/js/hs-count-characters.js"></script>
 
  <script src="/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="/assets/js/hs.chartjs.js"></script>
  @mediaLibraryStyles

<script>
    (function() {

      new HSSideNav('.js-navbar-vertical-aside').init()
      HSBsDropdown.init();

      HSCore.components.HSTomSelect.init(".js-select");
      new HSFormSearch('.js-form-search');
      new HSCountCharacters('.js-count-characters')

    })()
  </script>
<script>


 

  
  (function() {
    document.querySelectorAll('.js-chart').forEach(item => {
      HSCore.components.HSChartJS.init(item)
    })
  })();

      (function () {
        // STYLE SWITCHER
        // =======================================================
        const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
        const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

        // Function to set active style in the dorpdown menu and set icon for dropdown trigger
        const setActiveStyle = function () {
          $variants.forEach($item => {
            if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
              $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
              return $item.classList.add('active')
            }

            $item.classList.remove('active')
          })
        }

        // Add a click event to all items of the dropdown to set the style
        $variants.forEach(function ($item) {
          $item.addEventListener('click', function () {
            HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
          })
        })

        // Call the setActiveStyle on load page
        setActiveStyle()

        // Add event listener on change style to call the setActiveStyle function
        window.addEventListener('on-hs-appearance-change', function () {
          setActiveStyle()
        })
      })()

      
    </script>
 