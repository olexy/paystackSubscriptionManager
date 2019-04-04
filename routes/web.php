<?php

// Route::get('/', function () {
//     return view('welcome');
// });

// AUTHS

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// STATIC
Route::get('/addcust', function () {
    return view('addcust');
})->middleware('auth');


Route::get('/addplan', function () {
    return view('addplan');
})->middleware('auth');


// DATABSE LOGIC

//load sub page with customer and plan data
Route::get('/addsub', 'PagesController@loadCustPlan')->middleware('auth');

//load sub page with customer data
Route::get('/refsub', 'PagesController@loadCust')->middleware('auth');


// FORM PROCESSING

//process form => add customer to db
Route::post('/addcust', 'DbStorageController@storeCust');

//process form => create sub
Route::post('/createsub', 'DbStorageController@createSub');

//process form => add plan to db
Route::post('/addplan', 'DbStorageController@storePlan');


// AJAX AND JQUERY CONTROLLER  ROUTES

// Find amount on clicking customer name select button
Route::get('/findAmount', 'PagesController@findAmount');

// Find Customer name on clicking customer name select button
Route::get('/findCustName', 'PagesController@findCustName');

//find refcode based on chosen customer
Route::get('/findRef', 'PagesController@findRef');

Route::get('/callbackFunct', 'PagesController@callbackFunct');
