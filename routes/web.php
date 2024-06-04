<?php
use Symfony\Component\HttpFoundation\Session\Session;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\azureController;

Route::controller(azureController::class)->group(function(){
    Route::get('auth/callback', 'callback')->name('auth.microsoft');
});
Route::controller(azureController::class)->group(function(){
    Route::get('auth/azure/callback', 'callback')->name('auth.microsoft');
});


Route::get('/reset', function () {
    session()->flush();
   // Route::get('auth/azure/callback', 'callback')->name('auth.microsoft');
});


Route::get('/', function () {
    return view('auth.login');
});//name('auth.azure');

Route::get('/auth/azure', function () {
    return Socialite::driver('azure')->redirect();
})->name('auth.azure');


Route::get('/auth/logoff', [azureController::class, 'logoff'], function ($user) {
});

Route::get('/auth/noaccess', function () {
    return view('noaccess');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
//users routes
Route::group(['prefix' => 'user', ],
function ()
{
    Route::get('/tasks', \App\Http\Livewire\User\Tasks::class);
    Route::get('/notes', \App\Http\Livewire\User\Notes::class);

});


Route::get('vehicles', \App\Http\Livewire\Vehicle\Index::class);
Route::group(['prefix' => 'vehicle', ],
function ()
{
    Route::get('/add', \App\Http\Livewire\Vehicle\Add::class);
    Route::get('/edit/{id}', \App\Http\Livewire\Vehicle\Edit::class);
    Route::get('/{slug}', \App\Http\Livewire\Vehicle\Show::class);
 
 //  Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
});



 


Route::get('/search', \App\Http\Livewire\Company\Search::class);

//Company routes
Route::get('/support', \App\Http\Livewire\Support::class);

    Route::get('/masterdata', \App\Http\Livewire\Company\Masterdata::class);
    Route::get('/connections', \App\Http\Livewire\Connections::class);


    Route::group(
        ['prefix' => 'connections'],
        function () {
            Route::get('/liftinstituut', function () { return view('connection.liftinstituut');  });

            Route::get('/tuv', \App\Http\Livewire\Connection\Tuv::class);

 


        //    Route::get('/tuv', function () { return view('livewire.connection.tuv') ->layout('layouts.app');  });
            Route::get('/outsmart', function () { return view('/livewire/connection/outsmart');  });
            Route::get('/chex', function () { return view('/livewire/connection/chex');  });
            Route::get('/eboekhouden', function () { return view('/livewire/connection/eboekhouden');  });

        }
    );




    //Customers
    Route::get('/customers', \App\Http\Livewire\Company\Customers\Index::class);
    Route::group(['prefix' => 'customer', ],
    function ()
    {
        Route::get('edit/{slug}', \App\Http\Livewire\Company\Customers\Edit::class);
        Route::get('{slug}', \App\Http\Livewire\Company\Customers\Show::class);
        Route::get('/contact/{customer_id}/create', \App\Http\Livewire\Company\Customers\Contact\Create::class);
       // Route::get('/location/{customer_id}/create', \App\Http\Livewire\Company\Customers\Location\Create::class);
        Route::get('/project/{customer_id}/create', \App\Http\Livewire\Company\Customers\Project\Create::class);
    });

 
    //Addressess
    Route::get('/addresses', \App\Http\Livewire\Company\Addresses\Index::class);
    Route::group(['prefix' => 'address', ],
    function ()
    {
        Route::get('/edit/{slug}', \App\Http\Livewire\Company\Addresses\Edit::class);
        Route::get('/show/{slug}', \App\Http\Livewire\Company\Addresses\Show::class);
    });


//Settings

Route::group(['prefix' => 'settings', ],
function ()
{




       //Suppliers
       Route::get('/suppliers', \App\Http\Livewire\Company\Suppliers\Index::class);
       Route::group(['prefix' => 'supplier', ],
       function ()
       {
     //   Route::get('add', \App\Http\Livewire\Company\Suppliers\Add::class);
          Route::get('{slug}', \App\Http\Livewire\Company\Suppliers\Show::class);
    });       
    
    Route::get('/employees', \App\Http\Livewire\Settings\Employees::class);
   
    Route::get('/departments', \App\Http\Livewire\Settings\Departments::class);
    Route::get('/warehousings', \App\Http\Livewire\Settings\Warehousings::class);
    Route::group(['prefix' => 'workorders', ],
    function ()
    {
        Route::get('/statusses', \App\Http\Livewire\Settings\Workorders\Statusses::class);
        Route::get('/solutions', \App\Http\Livewire\Settings\Workorders\Solutions::class);
        Route::get('/errors', \App\Http\Livewire\Settings\Workorders\Errors::class);
        Route::get('/worktypes', \App\Http\Livewire\Settings\Workorders\Worktypes::class);
        Route::get('/regios', \App\Http\Livewire\Settings\Workorders\Regions::class);
        Route::get('/paymethods', \App\Http\Livewire\Settings\Workorders\Paymethods::class);
    });
});

    Route::get('/projects', \App\Http\Livewire\Company\Projects\Index::class);
    Route::group(['prefix' => 'project', ],
    function ()
    {
        Route::get('/edit/{id}', \App\Http\Livewire\Company\Projects\Edit::class);
        Route::get('/create', \App\Http\Livewire\Company\Projects\Create::class);
        Route::get('/{slug}', \App\Http\Livewire\Company\Projects\Show::class);
    });

     Route::get('/incidents', \App\Http\Livewire\Company\Incidents\Index::class);
      Route::group(['prefix' => 'incident'],
          function ()
          {
            Route::get('/{id}', \App\Http\Livewire\Company\Incidents\Show::class);
 //        Route::get('/{$slug}', \App\Http\Livewire\Company\Incidents\Show::class);
   });

    Route::get('/contacts', \App\Http\Livewire\Company\Contacts\Index::class);
    Route::get('/elevators', \App\Http\Livewire\Company\Elevators\Index::class);

    //Nieuw
    Route::group(['prefix' => 'contact', ],
        function ()
        {
            Route::get('/edit/{id}', \App\Http\Livewire\Company\Contacts\Edit::class);

        });


        Route::get('/locations', \App\Http\Livewire\Company\Locations\Index::class);

        Route::group(['prefix' => 'location', ],
        function ()
        {
            Route::get('/create', \App\Http\Livewire\Company\Locations\Create::class);
            Route::get('/edit/{id}', \App\Http\Livewire\Company\Locations\Edit::class);
            Route::get('/{slug}', \App\Http\Livewire\Company\Locations\Show::class);

        });

        Route::get('/knowledgebase', \App\Http\Livewire\Knowledgebase\Index::class);

     Route::group(['prefix' => 'knowledgebase', ],
       function ()
         {
          Route::get('/article/{slug}', \App\Http\Livewire\Knowledgebase\Articles\Show::class);
          Route::get('/categories', \App\Http\Livewire\Knowledgebase\Categories\Index::class);
          Route::get('/categorie/{slug}', \App\Http\Livewire\Knowledgebase\Categories\Show::class);
     
     });



    Route::group(['prefix' => 'elevator', ],
        function ()
        {
            Route::get('/edit/{id}', \App\Http\Livewire\Company\Elevators\Edit::class);
            Route::get('/show/{id}', \App\Http\Livewire\Company\Elevators\Show::class);
            Route::get('/create', \App\Http\Livewire\Company\Elevators\Create::class);

            //Contracten
                Route::get('/maintenance-contracts/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Contracts\Index::class);
              Route::get('/maintenance-contract/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\MaintenanceContracts\Create::class);
             //    Route::get('/contracts/edit/{id}', \App\Http\Livewire\Company\Contracts\Edit::class);

            //Onderhoudsbeurten
                Route::get('/maintenance/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Maintenance\Create::class);
                Route::get('/maintenance/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Maintenance\Index::class);
                Route::get('/maintenance/edit/{id}', \App\Http\Livewire\Company\Maintenance\Edit::class);

            //Werkopdrachten
                route::get('/workorders/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Workorders\Index::class);

            //informations
                route::get('/information/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Information\Index::class);

            //Bijlages
                route::get('/attachments/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Attachments\Index::class);

            //inspections
                Route::get('/inspections/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Inspections\Index::class);
                Route::get('/inspection/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Inspections\Create::class);
                Route::get('/inspection/edit/{id}', \App\Http\Livewire\Company\Inspections\Edit::class);
                Route::get('/inspection/show/{id}', \App\Http\Livewire\Company\Inspections\Show::class);

            //Incidenten
                Route::get('/incident/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Incidents\Create::class);
                Route::get('/incident/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Incidents\Index::class);


        });




    Route::get('/tickets', \App\Http\Livewire\Company\Tickets\Index::class);
    Route::group(['prefix' => 'ticket', ],
         function ()
         {
             Route::get('edit/{$slug}', \App\Http\Livewire\Company\Tickets\Edit::class);
             Route::get('show/{$slug}', \App\Http\Livewire\Company\Tickets\Show::class);
         });



         //Management companies
         Route::group(['prefix' => 'settings', ],   function ()
         {
         Route::get('/management-companies', \App\Http\Livewire\Company\managementCompanies\Index::class);
         Route::group(['prefix' => 'management-companie', ],
         function ()
         {


           Route::get('{id}', \App\Http\Livewire\Company\managementCompanies\Show::class);

         });


     //    Route::get('/inspections', \App\Http\Livewire\Company\Inspections\Index::class);
        //  Route::group(['prefix' => 'managementcompanies', ],
        //  function ()
        //  {
         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
        //  });





         Route::get('/maintenancy-companies', \App\Http\Livewire\Company\maintenanceCompanies\Index::class);
         Route::group(['prefix' => 'maintenancy-companie', ],
         function ()
         {


           Route::get('{id}', \App\Http\Livewire\Company\maintenanceCompanies\Show::class);

         });


         Route::get('inspection-companies', \App\Http\Livewire\Company\inspectionCompanies\Index::class);
         Route::group(['prefix' => 'inspection-companie', ],
         function ()
         {

            Route::get('{id}', \App\Http\Livewire\Company\inspectionCompanies\Show::class);

         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
         });

        });





//Company routes
Route::group(['prefix' => 'system', ],

function ()
{
    Route::get('/users', \App\Http\Livewire\System\User\Index::class);
    Route::group(['prefix' => 'user', ],
    function ()
    {
        Route::get('edit/{$slug}', \App\Http\Livewire\System\User\Edit::class);
        Route::get('show/{$slug}', \App\Http\Livewire\System\User\Show::class);
    });

});






        Route::get('/dashboard', \App\Http\Livewire\Dashboard::class);

});

//Schermen
Route::group(
    ['prefix' => 'screens'],
    function () {
        Route::get('/monitoring', \App\Http\Livewire\Screen\Monitoring::class);

    }
);
