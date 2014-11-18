<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// ----------------------------------------------
// Main page routes module ----------------------
// ----------------------------------------------

Route::get('/', "HomeController@get");

// Customer business logic

Route::get('customer', "CustomerController@get");

// Clerk business logic
Route::get('clerk', "ClerkController@get");

// Manager business logic
Route::get('manager', "ManagerController@get");

// Login/registration
Route::get('login', function(){
	DB::select();

});

Route::get('register', function(){
	return View::make('register');
});

Route::post('register', function(){
	
});

Route::post('/addAlbum', "ManagerController@addAlbum");

Route::post('/getTopItems', "ManagerController@getTopItems");

Route::post('/getTopItemsByDate', "ManagerController@getTopItemsByDate");