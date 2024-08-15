

@if (\Session::has('success'))
   <div class="alert alert-soft-success animate__animated animate__fadeIn" role="alert">
   {!! \Session::get('success') !!}
   </div>
@endif

@if (\Session::has('danger'))
   <div class="alert alert-soft-danger animate__animated animate__fadeIn" role="alert">
   {!! \Session::get('danger') !!}
   </div>
@endif

@if (\Session::has('warning'))
   <div class="alert alert-soft-warning animate__animated animate__fadeIn" role="alert">
   {!! \Session::get('warning') !!}
   </div>
@endif

@if (\Session::has('info'))
   <div class="alert alert-soft-info animate__animated animate__fadeIn" role="alert">
   {!! \Session::get('info') !!}
   </div>
@endif
 