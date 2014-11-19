<?php

class ManagerController extends BaseController {

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

	public function get(){
		return View::make("manager");
	}

	public function addAlbum(){
		DB:insert("INSERT INTO ITEMS VALUES (?,?)", "");
	}

	public function deleteAlbum(){
		DB::delete();
	}

	public function getTopItems(){
		DB::transactioin(function(){
			DB::select();
			DB::select();
		});
	}

	public function getTopItemsByDate(){
		
	}

}