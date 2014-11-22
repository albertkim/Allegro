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
		$title = Input::get("title");
		$category = Input::get("categoryu");
		$year = Input::get("year");
		$company = Input::get("company");
		$price = Input::get("price");
		$stock = Input::get("stock");

		$songNames = Input::get("songs");

		DB::transaction(function(){
			DB:insert("INSERT INTO ITEMS (TITLE, CATEGORY, COMPANY, YEAR, PRICE) VALUES (?,?)", array($title, $category, $company, $year, $price));
			
		});
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