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

Route::get('/', function(){
	return View::make('hello');
});

Route::get('customer', function(){
	return View::make('customer');
});

Route::get('clerk', function(){
	return View::make('clerk');
});

Route::get('manager', function(){
	return View::make('manager');
});

Route::get('login', function(){
	DB::select();

});

Route::get('register', function(){
	return View::make('register');
});

Route::post('register', function(){
	
});

// Routes used for data requests only

Route::post('/getTopItems', function(){
	// Return the top items sold of all time
});

// Misc data API

Route::post('/getTopItemsByDate', function(){
	// Given: date
	// Return the top items sold on given date
});