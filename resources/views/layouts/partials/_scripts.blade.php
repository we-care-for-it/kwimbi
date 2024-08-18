
<!-- JS Global Compulsory  -->
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></script>
<script src="/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>
<script src="/assets/js/hs.tom-select.js"></script>
<!-- JS Front -->
<script src="/assets/js/theme.min.js"></script>

<!-- JS Plugins Init. -->
<script>
(function() {
  // INITIALIZATION OF NAVBAR VERTICAL ASIDE
  // =======================================================
  new HSSideNav('.js-navbar-vertical-aside').init()


  // INITIALIZATION OF BOOTSTRAP DROPDOWN
  // =======================================================
  HSBsDropdown.init()

  HSCore.components.HSTomSelect.init(".js-select");
  // INITIALIZATION OF FORM SEARCH
  // =======================================================
  new HSFormSearch('.js-form-search')
})()
</script>

<!-- Style Switcher JS -->

<script>
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
