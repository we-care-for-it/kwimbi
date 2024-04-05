<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{env('APP_NAME')}} |  Liftindex</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @include('layouts.partials._styles')
<title> {{env('APP_NAME')}} |  Liftindex</title>
</head>

<body class = "bg-white">
 


<div class="div-center  " style = "  box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px!important;">

 <div class = "ddd ">
 <div class = " ">
<div class="text-center ">
	 <center>  <img style = "height: 100%" src="/storage/tenant/logo.png" alt="image"  ></center>
	</div> 
<br>

                                                @error('email') 
           


 <hr>

          

                                                <div class="alert-icon-area alert alert-warning " role="alert">


<div class="alert-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
</div>

<div class="alert-content">


    <p>De ingevoerde gebruikersnaam / wachtwoord is onjuist </p>


 
</div>

</div>
               @enderror 
      
          
             <form method="POST" action="{{ route('login') }}">
                  @csrf 


                                                    <div class="form-group mb-20">
                                                        <label for="username">Gebruikersnaam</label>
                                                      
                                                        <input name="email" id="email" tabindex = "1" type="email" placeholder="voorbeeld@domein.nl" required name="email" value="{{ old('email', request()->query('email')) }}" class = "form-control form-control-lg" autofocus/> 



                                                    </div>
                                                    <div class="form-group mb-15">
                                                        <label for="password-field">Wachtwoord</label>
                                                        <div class="position-relative">
                                                            <input id="password-field" type="password" class="form-control"  name="password" id="signupSrPassword" placeholder="*******" required minlength="5">
                                                            <div class="fa fa-fw fa-eye-slash text-light fs-16 field-icon toggle-password2"></div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex">
      <div class = "pt-3">
      <a class = " " href="forget-password.html">Wachtwoord vergeten</a>
      </div>
      <div class="ml-auto">
      <button type = "submit" class="btn btn-primary btn-default btn-squared text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                                          Inloggen
                                                        </button>
      </div>
 


                                             
                                              
</form>
 
  
</div></div></div>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>

    <!-- inject:js-->

    <script src="/assets/vendor_assets/js/jquery/jquery-3.5.1.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery/jquery-ui.js"></script>

    <script src="/assets/vendor_assets/js/bootstrap/popper.js"></script>

    <script src="/assets/vendor_assets/js/bootstrap/bootstrap.min.js"></script>

    <script src="/assets/vendor_assets/js/moment/moment.min.js"></script>

    <script src="/assets/vendor_assets/js/accordion.js"></script>

    <script src="/assets/vendor_assets/js/autoComplete.js"></script>

    <script src="/assets/vendor_assets/js/Chart.min.js"></script>

    <script src="/assets/vendor_assets/js/charts.js"></script>

    <script src="/assets/vendor_assets/js/daterangepicker.js"></script>

    <script src="/assets/vendor_assets/js/drawer.js"></script>

    <script src="/assets/vendor_assets/js/dynamicBadge.js"></script>

    <script src="/assets/vendor_assets/js/dynamicCheckbox.js"></script>

    <script src="/assets/vendor_assets/js/feather.min.js"></script>

    <script src="/assets/vendor_assets/js/footable.min.js"></script>

    <script src="/assets/vendor_assets/js/fullcalendar@5.2.0.js"></script>

    <script src="/assets/vendor_assets/js/google-chart.js"></script>

    <script src="/assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js"></script>

    <script src="/assets/vendor_assets/js/jquery.countdown.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery.filterizr.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery.magnific-popup.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery.mCustomScrollbar.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery.peity.min.js"></script>

    <script src="/assets/vendor_assets/js/jquery.star-rating-svg.min.js"></script>

    <script src="/assets/vendor_assets/js/leaflet.js"></script>

    <script src="/assets/vendor_assets/js/leaflet.markercluster.js"></script>

    <script src="/assets/vendor_assets/js/loader.js"></script>

    <script src="/assets/vendor_assets/js/message.js"></script>

    <script src="/assets/vendor_assets/js/moment.js"></script>

    <script src="/assets/vendor_assets/js/muuri.min.js"></script>

    <script src="/assets/vendor_assets/js/notification.js"></script>

    <script src="/assets/vendor_assets/js/popover.js"></script>

    <script src="/assets/vendor_assets/js/select2.full.min.js"></script>

    <script src="/assets/vendor_assets/js/slick.min.js"></script>

    <script src="/assets/vendor_assets/js/trumbowyg.min.js"></script>

    <script src="/assets/vendor_assets/js/wickedpicker.min.js"></script>

    <script src="/assets/theme_assets/js/drag-drop.js"></script>

    <script src="/assets/theme_assets/js/footable.js"></script>

    <script src="/assets/theme_assets/js/full-calendar.js"></script>

    <script src="/assets/theme_assets/js/googlemap-init.js"></script>

    <script src="/assets/theme_assets/js/icon-loader.js"></script>

    <script src="/assets/theme_assets/js/jvectormap-init.js"></script>

    <script src="/assets/theme_assets/js/leaflet-init.js"></script>

    <script src="/assets/theme_assets/js/main.js"></script>

    <!-- endinject-->
</body>

</html>

