<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <title> {{env('APP_NAME')}} | Liftindex</title>
   @include('layouts.partials._styles')
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   @csrf
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
        
      }
   </script>

</head>

   <body>
      <script src="/assets/js/hs.theme-appearance.js"></script>
      @include('layouts.partials._header')
      <main id="content" role="main" class="main pt-0  ">
   
            <div class="container container-fluid  ">  
               
            <div style="height: 72px;  border-radius: 10px; background-color: #7F7EFF"  class="   mt-0 mb-0">    
   
   <div class="container container-fluid  pt-3  ">  
   @include('layouts.partials._search')

</div>

   </div>
     
               <div>
                  <div class = "pt-3">
                     {{$slot}}
                  </div>
             
      </main>
      @include('layouts.partials._scripts')
   </body>
</html>