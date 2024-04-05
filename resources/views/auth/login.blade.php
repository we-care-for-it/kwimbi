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
    <main class="main-content">

        <div class="signUP-admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                        <div class="signUP-admin-left signIn-admin-left  d-none d-lg-flex" style = " background-image: url('/storage/tenant/elevators.jpg') ";  >
 S
                            </div><!-- End: .signUP-admin-left__content  -->
                            <div class="signUP-admin-left__img   d-md-block d-lg-none">
                             
                                
                            
                        </div><!-- End: .signUP-admin-left  -->
                    </div><!-- End: .col-xl-4  -->
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-8">
                        <div class="signUp-admin-ris p-md-40 p-10">
                          
                            <div class="row justify-content-center">
                                <div class="col-xl-7 col-lg-8 col-md-12">
                                    <div class=" ">
                                        <div class="card border-0">
                                        
                                            <div class="card-body">
                                                
          <div class=" pb-4">
                  <center>  <img src="/storage/tenant/logo.png"  style="max-height: 200px;" /></center>
               </div>
                                                @error('email') 
           


 

          

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
                                                    <div class="signUp-condition signIn-condition">
                                                   
                                                        <a href="forget-password.html">Wachtwoord vergeten</a>
                                                    </div>
                                                    <div class="button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                                        <button type = "submit" class="btn btn-primary btn-default btn-squared mr-15 text-capitalize lh-normal px-50 py-15 signIn-createBtn ">
                                                          Inloggen
                                                        </button>
                                                    </div>
</form>
                           
                                                </div>
                                            </div><!-- End: .card-body -->
                                        </div><!-- End: .card -->
                                    </div><!-- End: .edit-profile -->
                                </div><!-- End: .col-xl-5 -->
                            </div>
                        </div><!-- End: .signUp-admin-right  -->
                    </div><!-- End: .col-xl-8  -->
                </div>
  
        </div><!-- End: .signUP-admin  -->

    </main>
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

