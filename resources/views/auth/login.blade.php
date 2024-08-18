<x-guest-layout>
<style>
     .bottom {
    position: absolute;
    left: 20px;
    bottom: 10px; /* Set div position to relative */
  } 
</style>
   <div>

      <div class="container-fluid px-3">
         <div class="row">
            <div
               class="col-lg-6 d-none d-lg-flex justify-content-center bg-light align-items-center min-vh-lg-100 position-relative  px-0"
               style = " background-image: url('/tenant/background.png'); background-size: 500px;; background-repeat: no-repeat;background-position:center;">
               <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
                  <div class="d-none d-lg-flex  " style  = "  position: absolute; right: 10px">
                   <!-- Style Switcher -->
                   <div class="dropdown ">
                        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                           id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                           data-bs-dropdown-animation>

                        </button>

                        <div
                           class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless"
                           aria-labelledby="selectThemeDropdown">
                           <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                              <i class="bi-moon-stars me-2"></i>
                              <span class="text-truncate" title="Auto (system default)">Systeem standaard</span>
                           </a>
                           <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                              <i class="bi-brightness-high me-2"></i>
                              <span class="text-truncate" title="Default (light mode)">Standaard (licht)</span>
                           </a>
                           <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                              <i class="bi-moon me-2"></i>
                              <span class="text-truncate" title="Dark">Donker</span>
                           </a>
                        </div>
                     </div>

                  </div>
               </div>
               <div style="max-width: 23rem;">
                  <div class="text-center mb-5">

                  </div>
                  <div class="pb-3">
                 
                  </div>
                  <div class="mb-5">

                  </div>

                  <div class="row justify-content-between mt-5 gx-3">
                  </div>

               </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100; ">
               <div class=" content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
                  <div>
                     <div class="mb-3">
 
                    <center> <img src ="\assets\img\logo_liftindex.png" style = "max-height: 200px;"> </center><br><Br>
                        <div class="row pb-3">

                           @error('email')
                           <div style="height: 50px" class="mt-3 mb-3">
                              <div class="alert alert-soft-warning" role="alert"> De ingevoerde gebruikersnaam /
                                 wachtwoord is onjuist </div>
                           </div>
                           @enderror
                           <form method="POST" action="{{ route('login') }}">
                              @csrf

                              <div class="row ">
                                 <!-- Form -->
                                 <div class="mb-4 "> <label class="form-label">E-mailadres</label>

                                    <input name="email" id="email" tabindex="1" type="email"
                                       placeholder="voorbeeld@domein.nl" required name="email"
                                       value="{{ old('email', request()->query('email')) }}"
                                       class="form-control form-control-lg" autofocus /> <span
                                       class="invalid-feedback">Please enter a valid email address.</span> </div>
                                 <!-- End Form -->
                                 <!-- Form -->
                                 <div class="mb-4">
                                    <label class="form-label w-100" tabindex="0"> <span
                                          class="d-flex justify-content-between align-items-center">
                                          <span>Wachtwoord</span> <a class="form-label-link mb-0"
                                             href="{{ route('password.request') }}">Wachtwoord vergeten?</a> </span>
                                    </label>
                                    <div class="input-group input-group-merge" data-hs-validation-validate-class> <input
                                          type="password" tabindex="2" class="form-control form-control-lg"
                                          name="password" id="signupSrPassword" placeholder="*******" required
                                          minlength="5"> </div>
                                    <span class="invalid-feedback">Please enter a valid password.</span>
                                 </div>

                                 <!-- <label for="remember_me" class="flex items-center">
                    
                </label>                      -->

                                 <!-- End Form -->
                                 <!-- End Form Check -->
                                 <div class="d-grid"> <button type="submit"
                                       class="btn btn-primary btn-sm">Inloggen</button> </div>
                           </form>
                           <br /> <!-- End Accordion -->
                           <div class="pt-2 clearfix pb-3"> </div> <!-- Select -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
  <div class="bottom">
   <small>© Liftindex 2024 | <a href = "https://www.liftindex.nl"/>Helpdesk</a>  | <a href = "https://www.liftindex.nl"/>Contact</a> </small> </div>
            <script src="/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script>
         </div>

</x-guest-layout>