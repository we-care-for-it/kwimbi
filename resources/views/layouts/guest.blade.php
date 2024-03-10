<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title> {{env('APP_NAME')}} | Liftindex</title>

  <meta content='width=device-width, initial-scale=1' name='viewport' />

  <link rel="stylesheet" href="/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css" />
  <link href="/assets/css/custom.css" rel="stylesheet" />
  <link rel="preload" href="/assets/css/theme.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="/assets/css/theme-dark.css" data-hs-appearance="dark" as="style">
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  
  @laravelPWA
  @livewireStyles
  <script>
    window.hs_config = {
      "autopath": "@@autopath",
      "deleteLine": "hs-builder:delete",
      "deleteLine:build": "hs-builder:build-delete",
      "deleteLine:dist": "hs-builder:dist-delete",
      "previewMode": false,
      "startPath": "/index.html",
      "vars": {
        "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
        "version": "?v=1.0"
      },
      "layoutBuilder": {
        "extend": {
          "switcherSupport": true
        },
        "header": {
          "layoutMode": "default",
          "containerMode": "container-fluid"
        },
        "sidebarLayout": "default"
      },
      "themeAppearance": {
        "layoutSkin": "default",
        "sidebarSkin": "default",
        "styles": {
          "colors": {
            "primary": "#377dff",
            "transparent": "transparent",
            "white": "#fff",
            "dark": "132144",
            "gray": {
              "100": "#f9fafc",
              "900": "#1e2022"
            }
          },
          "font": "Inter"
        }
      },
      "languageDirection": {
        "lang": "en"
      },
      "skipFilesFromBundle": {
        "dist": ["assets/js/hs.theme-appearance.js", "assets/js/hs.theme-appearance-charts.js", "assets/js/demo.js"],
        "build": ["assets/css/theme.css",
          "assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js", "assets/js/demo.js",
          "assets/css/theme-dark.css", "assets/css/docs.css", "assets/vendor/icon-set/style.css",
          "assets/js/hs.theme-appearance.js", "assets/js/hs.theme-appearance-charts.js",
          "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js", "assets/js/demo.js"
        ]
      },
      "minifyCSSFiles": ["assets/css/theme.css", "assets/css/theme-dark.css"],
      "copyDependencies": {
        "dist": {
          "*assets/js/theme-custom.js": ""
        },
        "build": {
          "*assets/js/theme-custom.js": "",
          "node_modules/bootstrap-icons/font/*fonts/**": "assets/css"
        }
      },
      "buildFolder": "",
      "replacePathsToCDN": {},
      "directoryNames": {
        "src": "./src",
        "dist": "./dist",
        "build": "./build"
      },
      "fileNames": {
        "dist": {
          "js": "theme.min.js",
          "css": "theme.min.css"
        },
        "build": {
          "css": "theme.min.css",
          "js": "theme.min.js",
          "vendorCSS": "vendor.min.css",
          "vendorJS": "vendor.min.js"
        }
      },
      "fileTypes": "jpg|png|svg|mp4|webm|ogv|json"
    }
  </script>
  <script src="/assets/js/hs.theme-appearance.js"></script>

</head>

<body>

  <main id="content" role="main" class="main">
    {{$slot}}
  </main>

  @livewireScripts

  <script>
    (function() {
      const $dropdownBtn = document.getElementById('selectThemeDropdown')
      const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`)
      const setActiveStyle = function() {
        $variants.forEach($item => {
          if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
            $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
            return $item.classList.add('active')
          }
          $item.classList.remove('active')
        })
      }
      $variants.forEach(function($item) {
        $item.addEventListener('click', function() {
          HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
        })
      })
      setActiveStyle()
      window.addEventListener('on-hs-appearance-change', function() {
        setActiveStyle()
      })
    })()
  </script>

  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>
  <script src="/assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
  <script src="/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>
  <script src="/assets/vendor/clipboard/dist/clipboard.min.js"></script>
  <script src="/assets/js/theme.min.js"></script>
  <script src="/assets/vendor/hs-count-characters/dist/js/hs-count-characters.js"></script>
  <script src="/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></script>

</body>

</html>