<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




//Locations
Route::get('/locations', \App\Http\Livewire\Company\Locations\Index::class);
Route::group(['prefix' => 'location', ],
function ()
{
    Route::get('/edit/{id}', \App\Http\Livewire\Company\Locations\Edit::class);
    Route::get('/add', \App\Http\Livewire\Company\Locations\Add::class);
    Route::get('/{slug}', \App\Http\Livewire\Company\Locations\Show::class);
});


//Company routes
Route::group(['prefix' => 'company', ],

function ()
{
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
Route::get('/elevators/archive', \App\Http\Livewire\Company\Elevators\Indexarchive::class);
Route::group(['prefix' => 'elevator', ],
  function ()
  {
      Route::get('/edit/{id}', \App\Http\Livewire\Company\Elevators\Show::class);
      Route::get('/show/{id}', \App\Http\Livewire\Company\Elevators\Show::class);
      Route::get('/create', \App\Http\Livewire\Company\Elevators\Create::class);
  });


Route::get('/tickets', \App\Http\Livewire\Company\Tickets\Index::class);
Route::group(['prefix' => 'ticket', ],
   function ()
   {
       Route::get('edit/{$slug}', \App\Http\Livewire\Company\Tickets\Edit::class);
       Route::get('show/{$slug}', \App\Http\Livewire\Company\Tickets\Show::class);
   });



   //Management companies

   Route::get('/management.companies', \App\Http\Livewire\Company\managementCompanies\Index::class);
   Route::group(['prefix' => 'managementcompanies', ],
   function ()
   {
   //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
    //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
   });


   Route::get('/inspections', \App\Http\Livewire\Company\Inspections\Index::class);
  //  Route::group(['prefix' => 'managementcompanies', ],
  //  function ()
  //  {
   //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
    //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
  //  });


  //inspections
//  Route::get('/inspections/{elevator_id}/index', \App\Http\Livewire\Company\Elevators\Inspections\Index::class);
//  Route::get('/inspection/{elevator_id}/create', \App\Http\Livewire\Company\Elevators\Inspections\Create::class);
   Route::get('/inspection/edit/{id}', \App\Http\Livewire\Company\Inspections\Edit::class);



   Route::get('/maintenance.companies', \App\Http\Livewire\Company\maintenanceCompanies\Index::class);
   Route::group(['prefix' => 'maintenancecompanies', ],
   function ()
   {
   //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
    //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
   });

//   Route::get('/inspection.companies', \App\Http\Livewire\inspectionCompanies\Index::class);
   Route::group(['prefix' => 'inspectioncompanies', ],
   function ()
   {
   //    Route::get('edit/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Edit::class);
    //   Route::get('show/{$slug}', \App\Http\Livewire\Company\ManagementCompanies\Show::class);
   });









});
