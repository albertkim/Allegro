<?php

class ClerkController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function get()
	{
		return View::make("clerk");
	}

	public function checkAlbumDate(int receiptId) 
	{
		// enter receiptID and if true, check refund table if already returned, if false, then refund item
		
	}

}