<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'namespace'=> 'Admin', 'middleware' => 'IsAdminUser'], function () {
    Route::get('/dashboard','AdminUserController@dashboard');
    Route::get('/account','AdminUserController@account');
    Route::put('/update/{id}','AdminUserController@update_admin')->name('admin.update');
    Route::resource('/users', 'AdminUserController');
    Route::resource('/products', 'ProductController');
    Route::resource('/client/{id}/reservations','AdminClientReservationController');

    Route::resource('/reservations','ReservationController' , ["as"=>"admin"]);
    // Route::get('/reservations','ReservationController@index');
    // Route::get('/reservations/{id}/edit','ReservationController@edit')->name('reservations.edit');
    // Route::post('/reservations/{id}/','ReservationController@update')->name('reservations.update');
    // Route::delete('/reservations/{id}/','ReservationController@update')->name('reservations.destroy');


});

Route::group(['prefix' => 'clients', 'namespace'=> 'Client'], function () {
    Route::get('/dashboard','ClientController@dashboard');
    Route::get('/profile','ClientController@profile');
    Route::resource('/reservations','ReservationController', ["as"=>"client"]);
});
