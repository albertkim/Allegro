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

Route::post('checkRefund', "ClerkController@checkRefund");

// Login/registration business logic
Route::post('login', "UserController@login");

Route::post('logout', "UserController@logout");

Route::get('register', "UserController@getRegister");

Route::post('addUser', "UserController@addUser");

// Manager business logic
Route::get('manager', "ManagerController@get");

Route::post('addAlbum', "ManagerController@addAlbum");

Route::post('deleteAlbum', "ManagerController@deleteAlbum");

Route::post('getTopItems', "ManagerController@getTopItems");

Route::post('getTopItemsByDate', "ManagerController@getTopItemsByDate");

