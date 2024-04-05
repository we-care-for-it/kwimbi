<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StrikingDash</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->
    @include('layouts.partials._styles')


    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
</head>

<body>
    <main class="main-content">

        <div class="signUP-admin">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                        <div class="signUP-admin-left signIn-admin-left position-relative">
                            <div class="signUP-overlay">
 
                            </div><!-- End: .signUP-overlay  -->
                            <div class="signUP-admin-left__content">
                                <div class="text-capitalize mb-md-30 mb-15 d-flex align-items-center justify-content-md-start justify-content-center">
                                    <a class="wh-36 bg-primary text-white radius-md mr-10 content-center" href="index.html">a</a>
                                    <span class="text-dark">admin</span>
                                </div>
                                <h1>Bootstrap 4 React Web Application</h1>
                            </div><!-- End: .signUP-admin-left__content  -->
                            <div class="signUP-admin-left__img">
                                <img class="img-fluid svg" src="/storage/tenant/logo.png" alt="img" />


                                
                            </div><!-- End: .signUP-admin-left__img  -->
                        </div><!-- End: .signUP-admin-left  -->
                    </div><!-- End: .col-xl-4  -->
                    <div class="col-xl-8 col-lg-7 col-md-7 col-sm-8">
                        <div class="signUp-admin-right signIn-admin-right  p-md-40 p-10">
                            <div class="signUp-topbar d-flex align-items-center justify-content-md-end justify-content-center mt-md-0 mb-md-0 mt-20 mb-1">
                                
                            </div><!-- End: .signUp-topbar  -->
                            <div class="row justify-content-center">
                                <div class="col-xl-7 col-lg-8 col-md-12">
                                    <div class="edit-profile mt-md-25 mt-0">
                                        <div class="card border-0">
                                            <div class="card-header border-0  pb-md-15 pb-10 pt-md-20 pt-10 ">
                                                <div class="edit-profile__title">
                                                
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="edit-profile__body">

                                                @error('email') 
               <div style = "height: 50px" class = "mt-3 mb-3">
                  <div class="alert alert-soft-warning" role="alert"> De ingevoerde gebruikersnaam / wachtwoord is onjuist </div>
               </div>
               @enderror 
               
                                                <form method="POST" action="{{ route('login') }}">
                  @csrf 


                                                    <div class="form-group mb-20">
                                                        <label for="username">Gebruikersnaam</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Username">
                                                    </div>
                                                    <div class="form-group mb-15">
                                                        <label for="password-field">Wachtwoord</label>
                                                        <div class="position-relative">
                                                            <input id="password-field" type="password" class="form-control" name="password" value="secret">
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
                                                    <p class="social-connector text-center mb-sm-25 mb-15  mt-sm-30 mt-20"><span>Or</span></p>
                                                    <!-- <div class="button-group d-flex align-items-center justify-content-md-start justify-content-center">
                                                        <ul class="signUp-socialBtn">
                                                            <li>
                                                                <button class="btn text-dark px-30"><img class="svg" src="img/svg/google.svg" alt="img" /> Sign up with
                                                                    Google</button>
                                                            </li>
                                                            <li>
                                                                <button class=" radius-md wh-48 content-center"><img class="svg" src="img/svg/facebook.svg" alt="img" /></button>
                                                            </li>
                                                            <li>
                                                                <button class="radius-md wh-48 content-center"><img class="svg" src="img/svg/twitter.svg" alt="img" /></button>
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                            </div><!-- End: .card-body -->
                                        </div><!-- End: .card -->
                                    </div><!-- End: .edit-profile -->
                                </div><!-- End: .col-xl-5 -->
                            </div>
                        </div><!-- End: .signUp-admin-right  -->
                    </div><!-- End: .col-xl-8  -->
                </div>
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

