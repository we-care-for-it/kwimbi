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
         <div style="height: 70px; background-color: #555559; " class="w-100 mt-0 pt-0 ">
            <div class="container content  pt-3 mt-0  ">
               <div class=" p-3 pt-0 mt-0    mb-0 "
                  style="background-color: white; border-radius: 10px; height: 80px;  border: 1px solid #EFF2FB   ">
                  @include('layouts.partials._search') </div>
               <div>
                  <div class="  pt-0 mt-0  " style="background-color: white;  border-radius: 10px;  ">
                     {{$slot}}
                  </div>
               </div>
      </main>
      @include('layouts.partials._scripts')
   </body>
</html>