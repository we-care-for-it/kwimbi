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

Route::get('/search', \App\Http\Livewire\Company\Search::class);
      
//Company routes

    Route::get('/masterdata', \App\Http\Livewire\Company\Masterdata::class);
  
    //Projecten
    Route::get('/projects', \App\Http\Livewire\Company\Projects\Index::class);
    Route::group(['prefix' => 'project', ],
    function ()
    {
        Route::get('edit/{$slug}', \App\Http\Livewire\Company\Projects\Edit::class);
        Route::get('show/{$slug}', \App\Http\Livewire\Company\Projects\Show::class);
    });

    //Customers
    Route::get('/customers', \App\Http\Livewire\Company\Customers\Index::class);
    Route::group(['prefix' => 'customer', ],
    function ()
    {
        Route::get('edit/{slug}', \App\Http\Livewire\Company\Customers\Edit::class);
        Route::get('{slug}', \App\Http\Livewire\Company\Customers\Show::class);
    });

    //Suppliers
    Route::get('/suppliers', \App\Http\Livewire\Company\Suppliers\Index::class);
    // Route::group(['prefix' => 'supplier', ],
    // function ()
    // {
    //     Route::get('edit/{slug}', \App\Http\Livewire\Company\Suppliers\Edit::class);
    //     Route::get('{slug}', \App\Http\Livewire\Company\Suppliers\Show::class);
    // });

    //Addressess
    Route::get('/addresses', \App\Http\Livewire\Company\Addresses\Index::class);
    Route::group(['prefix' => 'address', ],
    function ()
    {
        Route::get('/edit/{slug}', \App\Http\Livewire\Company\Addresses\Edit::class);
        Route::get('/show/{slug}', \App\Http\Livewire\Company\Addresses\Show::class);
    });


    
    //Addressess
    Route::get('/projects', \App\Http\Livewire\Company\Projects\Index::class);
    Route::group(['prefix' => 'projects', ],
    function ()
    {
        // Route::get('/edit/{slug}', \App\Http\Livewire\Company\Addresses\Edit::class);
        // Route::get('/show/{slug}', \App\Http\Livewire\Company\Addresses\Show::class);
    });

//ss

     Route::get('/incidents', \App\Http\Livewire\Company\Incidents\Index::class);
      Route::group(['prefix' => 'incident'],
          function ()
          {
            Route::get('show/{id}', \App\Http\Livewire\Company\Incidents\Show::class);
 //        Route::get('/{$slug}', \App\Http\Livewire\Company\Incidents\Show::class);
   });

    Route::get('/contacts', \App\Http\Livewire\Company\Contacts\Index::class);
    Route::get('/elevators', \App\Http\Livewire\Company\Elevators\Index::class);
    Route::group(['prefix' => 'elevator', ],
        function ()
        {
            Route::get('/edit/{id}', \App\Http\Livewire\Company\Elevators\Show::class);
            Route::get('/show/{id}', \App\Http\Livewire\Company\Elevators\Show::class);
            Route::get('/create', \App\Http\Livewire\Company\Elevators\Create::class);
            
            Route::get('/maintenance-contract/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\MaintenanceContracts\create::class);
            Route::get('/inspection/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Inspections\create::class);
            Route::get('/maintenance/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Maintenance\create::class);
            
        });

        Route::get('/maintenance/edit/{id}', \App\Http\Livewire\Company\Maintenance\edit::class);
        Route::get('/inspection/edit/{id}', \App\Http\Livewire\Company\Inspections\edit::class);
        Route::get('/maintenance-contract/edit/{id}', \App\Http\Livewire\Company\MaintenanceContracts\edit::class);

    Route::get('/tickets', \App\Http\Livewire\Company\Tickets\Index::class);
    Route::group(['prefix' => 'ticket', ],
         function ()
         {
             Route::get('edit/{$slug}', \App\Http\Livewire\Company\Tickets\Edit::class);
             Route::get('show/{$slug}', \App\Http\Livewire\Company\Tickets\Show::class);
         });

   

         //Management companies
        
         Route::get('/management-companies', \App\Http\Livewire\Company\managementCompanies\Index::class);
         Route::group(['prefix' => 'managementcompanies', ],
         function ()
         {
         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
         });


     //    Route::get('/inspections', \App\Http\Livewire\Company\Inspections\Index::class);
        //  Route::group(['prefix' => 'managementcompanies', ],
        //  function ()
        //  {
         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
        //  });



        
         Route::get('/maintenancy-companies', \App\Http\Livewire\Company\maintenanceCompanies\Index::class);
         Route::group(['prefix' => 'maintenancecompanies', ],
         function ()
         {
         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
         });

         Route::get('/inspection-companies', \App\Http\Livewire\Company\inspectionCompanies\Index::class);
         Route::group(['prefix' => 'inspectioncompanies', ],
         function ()
         {
         //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
          //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
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

     