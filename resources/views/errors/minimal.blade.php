<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <title>@yield('code') |  @yield('message')</title>
      <script src="https://cdn.tailwindcss.com"></script>
   </head>
   <body class="min-h-screen overflow-y-auto text-gray-900">
      <div class="flex min-h-screen items-center justify-center py-12 text-gray-900">
         <div class="relative  ">
            <div class="flex w-full justify-center pb-4">
               <img src="/images/digilevel_logo.png" alt="Logo" style = "height: 150px;" class=" mx-auto mb-4">
            </div>
            <h2 class="text-center text-2xl font-bold tracking-tight pb-4">
               {{$exception?->getStatusCode()}}
            </h2>
            <p class="  text-center ">
               @yield('message')
            </p>
            <p class="text-center mt-5 font-medium">
               <button  onclick="window.history.back()" class="rounded-lg bg-stone-600 hover:bg-slate-500 text-white py-2 px-4  ">Ga Terug</button>
            </p>
            @if(Auth::user()?->companies=='[]' && $exception?->getStatusCode()=='404' )
                <p class="text-center   mt-5 font-medium">
                    <div class = "text-center text-stone-400 text-sm p-4 bg-stone-100">
                        De inglogde gebruiker ({{Auth::user()->email}}) is niet gekoppeld aan een klant omgeving.<br>
                        Vraag de beheerder om je account toe te voegen of login met een andere account
                    </div>

                    <a class = "pt-5" href = "/app">>Loguit</a>
                </p>
            @endif
            <div class="w-full text-stone-300  fixed bottom-0 pb-7" >
            {{$exception?->getMessage()}}
            </div>
         </div>
      </div>
   </body>
</html>
