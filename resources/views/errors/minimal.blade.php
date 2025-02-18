<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <title>@yield('code') |  @yield('message')</title>
      <script src="https://cdn.tailwindcss.com"></script>
   </head>
   <body class="min-h-screen overflow-y-auto text-gray-900">
      <div class="flex min-h-screen items-center justify-center py-12 text-gray-900">
         <div class="relative  ">
            <div class="flex w-full justify-center pb-4">
               <img src="/images/digilevel_logo.png" alt="Logo" style = "height: 100px;" class=" mx-auto mb-4">
            </div>
            <h2 class="text-center text-2xl font-bold tracking-tight pb-4">
               Foutmelding: @yield('code')
            </h2>
            <p class="  text-center ">
               @yield('message')
            </p>
            <p class="text-center mt-5 font-medium">
               <button  onclick="window.history.back()" class="rounded-lg bg-stone-600 hover:bg-slate-500 text-white py-2 px-4  ">Ga Terug</button>
            </p>


         </div>
      </div>
   </body>
</html>
