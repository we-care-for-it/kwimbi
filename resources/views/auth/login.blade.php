<x-guest-layout>
<style>
     .bottom_right {
    position: absolute;
    right: 20px;
    bottom: 10px; /* Set div position to relative */
  } 
  .bottom_left {
    position: absolute;
    left: 20px;
    bottom: 10px; /* Set div position to relative */
  } 

</style>
   <div>

      <div class="container-fluid px-3">
         <div class="row">
            <div
               class="col-lg-6 bg-light  d-none d-lg-flex justify-content-center  justify-content-end  align-items-center min-vh-lg-100 position-relative  px-0"
           >

           <img src ="\assets\img\documents.svg" style = "height: 400px">

               <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3 justify-content-end">
               <div class="dropdown ">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation=""><i class="bi-brightness-high"></i></button>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                  <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                    <i class="bi-moon-stars me-2"></i>
                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                  </a>
                  <a class="dropdown-item active" href="#" data-icon="bi-brightness-high" data-value="default">
                    <i class="bi-brightness-high me-2"></i>
                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                  </a>
                  <a class="dropdown-item" href="#" data-icon="bi-moon" data-value="dark">
                    <i class="bi-moon me-2"></i>
                    <span class="text-truncate" title="Dark">Dark</span>
                  </a>
                </div>
              </div>


          

               </div>
               <div style="max-width: 23rem;">
               <ul class="list-checked list-checked-lg list-checked-primary  ">
              <li class="list-checked-item">
                <span class="d-block fw-semibold mb-1">Gebouwbeheer</span>
                Beheer de eigenschappen van de complexen
              </li>

              <li class="list-checked-item">
                <span class="d-block fw-semibold  ">Projecten</span>
              Maak projecten aan en koppel alle relevante informatie van de projecten op 1 plek
              </li>
              <li class="list-checked-item">
                <span class="d-block fw-semibold mb-1">Liftbeheer</span>
            Registeer Onderhoudsbeurten, Storingen en lift eigenschappen
              </li>
            </ul>

               </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100; ">
               <div class=" content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
                  <div>
                     <div class="mb-3">
                 
    
                    <a class="btn btn-white btn-lg d-grid mb-4" href="#">
                               <span class="d-flex justify-content-center align-items-center">
                               <img class="avatar sociallogin  me-2" src="/assets/svg/brands/microsoft-office-365-logo.png" alt="Image Description">
                              Login met Microsoft office365
                               </span>
                               </a>
                               <span class="divider-center text-muted mb-4">OF</span>



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
            <div class="bottom_left">
              <b> 
            </div>

            <div class="bottom_left">
            {{env('APP_NAME')}} </b> | LTS Liftbeheer
</div>     



  <div class="bottom_right">
   <small>© LTS Software B.V. | <a href = "https://www.liftindex.nl"/>Helpdesk</a>  | <a href = "https://www.liftindex.nl"/>Contact</a> </small> </div>
            <script src="/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script>
         </div>

</x-guest-layout>