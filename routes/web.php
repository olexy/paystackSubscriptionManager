<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/addcust', function () {
    return view('addcust');
})->middleware('auth');


Route::post('/addcust', 'DbStorageController@storeCust');

Route::get('/addplan', function () {
    return view('addplan');
})->middleware('auth');

Route::get('/addsub', function () {
    return view('addsub');
})->middleware('auth');

