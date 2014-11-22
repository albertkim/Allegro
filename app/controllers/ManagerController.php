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
		$album = file_get_contents("php://input");
		$album = json_decode($album, true);

		DB::transaction(function() use ($album){
			DB::insert("INSERT INTO ITEM (TITLE, CATEGORY, COMPANY, YEAR, PRICE) VALUES (?,?,?,?,?)", 
				array($album["title"], $album["category"], $album["company"], $album["year"], $album["price"]));
		});

		return($album);
	}

	public function deleteAlbum(){
		DB::delete();
	}

	public function getTopItems(){
		DB::transaction(function(){
			DB::select();
			DB::select();
		});
	}

	public function getTopItemsByDate(){
		
	}

}