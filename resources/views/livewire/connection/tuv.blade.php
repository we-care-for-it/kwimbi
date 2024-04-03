@extends('layouts.tenant')

@section('content')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">

            <h1 class="page-header-title">Koppelingen - Liftinstituut</h1>
            <span class=" mb-2 text-muted">Koppeling Liftinstituut </span>
        </div>
        <div class="col-auto">
            <button type="button" onclick="history.back()" class="btn btn-soft-secondary btn-120   btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Terug
            </button>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">     @if(tenant('liftinstituut_api_1'))

<div class="alert alert-soft-info" role="alert">
    Koppeling is actief
</div>

@else

<div class="alert alert-soft-warning" role="alert">
    Koppeling is niet actief. Intresse? neem contact op met onze support afdeling
</div>
@endif
        <div class="card  p-2 border">
            <div class="card-body">

           

                <img class="border-right" style="  width:120px; float: left; padding-right: 20px"
                    src="/assets/img/external/Liftinstituut-logo.svg">

                <h1>Liftinstituut

                    <p class="p-0 m-0"> <small>Sinds 1933 zet Liftinstituut zich in voor een wereld waarin iedereen alle liften en roltrappen zorgeloos en veilig kan gebruiken. Vanuit onze passie voor techniek en veiligheid delen we onze kennis en ervaring met de wereld. Dat doen we bovenal met veiligheidskeuringen en certificatietrajecten
        </div>
    </div>
</div>

<div class="row pt-3">
    <div class="col-md-12">

        <div class="card-header">
            Koppeling gegevens
        </div>
        <div class="card-body">

            <!-- Accordion -->
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="headingOne">
                    <a class="accordion-button " role="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                     
                
                            API verbinding gegegevens
                        </a>
                    </div>

                    
                    <div id="collapseOne" class="accordion-collapse collapse  " aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <table class="table">
                                <tr>
                                    <td style="width: 220px;" class="align-middle">Token</td>
                                    <td>
                                        {{ tenant('liftinstituut_api_1')}}

                                    </td>
 
                                </tr>
 

                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="headingTwo">
                        <a class="accordion-button " role="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Logboek
                        </a>
                    </div>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">


                        
                        <div class="accordion-body">
                        @livewire('tenant.api-log', ['module' => 'liftinstituut'])
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Accordion -->

        </div>
    </div>
</div>

@endsection