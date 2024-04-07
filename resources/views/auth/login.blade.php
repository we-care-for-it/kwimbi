<x-guest-layout>
 
<div>
 
   <div class="container-fluid px-3">
   <div class="row">
   <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-light px-0">
      <div class="position-absolute top-0 start-0 end-0 mt-3 mx-3">
         <div class="d-none d-lg-flex justify-content-between">
            <a href="./index.html"> </a> <!-- End Select --> 
         </div>
      </div>
      <div style="max-width: 23rem;">
            <div class="text-center mb-5">
          
            
            
      </div>
            <div class = "pb-3">
               <center> <img src="/storage/tenant/logo.png" style="width: 300px;" /> </center>
</div>
            <div class="mb-5">
             
            </div>

            <!-- List Checked -->
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

            <div class="row justify-content-between mt-5 gx-3">  
            </div>  
 
      </div>
   </div>
   <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
      <div class=" content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
         <div>
            <div class="mb-3">
               <div class="d-md-block d-lg-none pb-4">
                  <center>  <img src="/storage/tenant/logo.png"  style="width: 300px;" /></center>
               </div>
               


               <div class="row pb-3">
                 
                  
                  
               
               
             
               @error('email') 
               <div style = "height: 50px" class = "mt-3 mb-3">
                  <div class="alert alert-soft-warning" role="alert"> De ingevoerde gebruikersnaam / wachtwoord is onjuist </div>
               </div>
               @enderror 
               <form method="POST" action="{{ route('login') }}">
                  @csrf 
                  
                  <div class="row ">
                     <!-- Form --> 
                     <div class="mb-4 "> <label class="form-label" >E-mailadres</label> 
                     
                     <input name="email" id="email" tabindex = "1" type="email" placeholder="voorbeeld@domein.nl" required name="email" value="{{ old('email', request()->query('email')) }}" class = "form-control form-control-lg" autofocus/> <span class="invalid-feedback">Please enter a valid email address.</span> </div>
                     <!-- End Form --> <!-- Form --> 
                     <div class="mb-4">
                        <label class="form-label w-100" tabindex="0"> <span class="d-flex justify-content-between align-items-center"> <span>Wachtwoord</span> <a class="form-label-link mb-0" href="{{ route('password.request') }}">Wachtwoord vergeten?</a> </span> </label> 
                        <div class="input-group input-group-merge" data-hs-validation-validate-class> <input type="password" tabindex = "2" class="form-control form-control-lg" name="password" id="signupSrPassword" placeholder="*******" required minlength="5" > </div>
                        <span class="invalid-feedback">Please enter a valid password.</span> 
                     </div>


                     <!-- <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>                      -->

                     <!-- End Form --> <!-- End Form Check --> 
                     <div class="d-grid"> <button type="submit" class="btn btn-primary btn-sm">Inloggen</button> </div>
               </form>
               <br /> <!-- End Accordion --> <div class = "pt-2 clearfix pb-3"> </div> <!-- Select --> </div> 
            </div>
         </div>
      </div>
    </div>
 
<script src="/assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script> 
</div>

 
</x-guest-layout>