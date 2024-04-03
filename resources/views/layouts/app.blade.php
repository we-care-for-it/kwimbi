<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> {{env('APP_NAME')}} |  Liftindex</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->


    @include('layouts.partials._styles')

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Zoeken...">
        </form>
    </div>

    <div class="mobile-author-actions"></div>
    @include('layouts.partials._header')
    <main class="main-content">
  @include('layouts.partials._aside')


        <div class="contents  ">

            <div class="container-fluid">
                {{$slot}}
                </div>
            </div>

        </div>

    </main>

 
      @include('layouts.partials._scripts')

    <!-- endinject-->
</body>

</html>
