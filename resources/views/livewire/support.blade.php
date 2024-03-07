<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
          Help 
         </div>

         <div class="col-auto">
 

            <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  btn-ico">
               <i class="fa-solid fa-arrow-left"></i>
            </button>

         </div>

      </div>
   </div>

   
   <div class="row pt-3">
       <div class="col-md-6">
          <div class="card">
          <div class="card-body" style = "height: 270px" >

            <div class = "row">
            <div class = "col-md-3">
            <img src = "/assets/img/LTS Software B.V.png" style = "height: 100px">
</div>

<div class = "col-md-9">   <b>LTS Software B.V.</b><br>
                Keenenburgweg 10<br>
                <div class = "pt-2">
                <i class="bi bi-envelope"></i> 2627 GM Schipluiden<br>
                </div>
                <div class = "pt-2">
                <i class="bi bi-telephone"></i> 32131321<br>
                </div>

         

                <div class = "pt-2">
                    <hr>
                <a href = "mailto:info@lts-software.nl"> info@lts-software.nl</a>
             <br>
                <a href = "https://www.lts-software.nl"> https://www.lts-software.nl</a>
                </div>
</div>

</div>

    
             

             </div>
          </div>
       </div>
       <div class="col-md-6">
          <div class="card">

             <div class="card-body" style = "height: 270px" >
                <label  class = "mb-2 ">Onderwerp</label>
             <select class = "form-select mb-2" wire:model = "support_subject">
                <option value = "Nieuwe functie">Nieuwe functie</option>
                <option value = "Probleem / Foutmelding">Probleem / Foutmelding</option>
                <option value = "Idee of sugestie">Idee of sugestie</option>
                <option value = "Anders">Anders</option>
             </select>

             <label  class = "mb-2">Bericht</label>
             <textarea class = "form-control" wire:model = "support_message"></textarea>
<div style = "float: right">
    <button wire:click = "sendSupportMessage()" class = "btn btn-success bt-sm mt-3"> Versturen</button>
</div>


             </div>
          </div>
       </div>

    </div>
          <div class="row pt-3">
          <div class="col-md-12">
          <div class="card">
 <!-- Accordion -->
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <div class="accordion-header" id="headingOne">
      <a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        Is mijn opgeslagen data gegevens veilig ?
      </a>
    </div>
    <div id="collapseOne" class="accordion-collapse collapse  " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      Het beschermen van de data in Lift Index is een van onze prioriteiten. We hanteren dan ook het principe 'security by design'. Daarbij gaat het met name om het voorkomen van datalekken en het verlies van data. Dit kan gebeuren door technische storingen, menselijk handelen of criminele activiteiten.
      <br><br>
Hosting van de data is ondergebracht in een Nederlands datacenter met de ISO 27001:2013, NEN 7510:2017 en ISO 9001:2015 certificeringen. Van de verschillende omgevingen van Lift Index worden frequent back-ups gemaakt. Daarnaast moet voorkomen worden dat data gestolen of gegijzeld kan worden. Om die reden is er bewust geen exporteer functie beschikbaar, voor zowel reguliere (API-)gebruikers als beheerders en andere gebruikers die toegang hebben tot Lift Index.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header" id="headingTwo">
      <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
       Kan ik mijn eigen systeem koppelen aan Lift index
      </a>
    </div>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      Om data uit te wisselen met uw (bedrijfs-) softwaresysteem, is er een API (application programming interface) ontwikkeld.  Neem hiervoor contact op via <a href = "mailto:info@lts-software.nl"> info@lts-software.nl</a>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <div class="accordion-header" id="headingThree">
      <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      Heeft iedereen toegang tot de data die wij invoeren
      </a>
    </div>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
     Nee, U bepaalt zelf welke gegeven u met iemand deelt.
      </div>
    </div>
  </div>

  <!-- <div class="accordion-item">
    <div class="accordion-header" id="headingThree">
      <a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        Accordion Item #3
      </a>
    </div>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div> -->


</div>
<!-- End Accordion -->
               </div>
             </div>
 



          
         </div>


       </div>
    </div>
 </div>


</div>
