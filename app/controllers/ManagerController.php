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

			$id = DB::table("item")->insertGetId(
				array(
					"title" => $album["title"],
					"type" => $album["type"],
					"category" => $album["category"],
					"company" => $album["company"],
					"year" => $album["year"],
					"stock" => $album["stock"],
					"price" => $album["price"]
				)
			);

			if(!$id){
				return("Could not add album");
			}

			// add artist relation to album
			$leadSinger = DB::table("leadSinger")->insert(
				array(
					"upc" => $id,
					"name" => $album["artist"]
				)
			);

			if(!$leadSinger){
				return("Could add lead singer");
			}

			// add each song relation to album
			foreach($album["songs"] as $song){
				DB::table("hasSong")->insert(
					array(
						"upc" => $id,
						"title" => $song["title"]
					)
				);
			}
		});

		return("Album successfully added");
	}

	public function deleteAlbum(){
		DB::delete();
	}

	public function getTopItems(){
		$topItems = DB::select("SELECT I.UPC, SUM(QUANTITY) FROM PURCHASEITEM P, ITEMS I, GROUP BY I.UPC ORDER BY SUM(QUANTITY) DESC");

		return json_encode($topItems);
	}

	public function getTopItemsByDate(){
		log::info("POST getTopItemsByDate");
		$date = Input::get("date");
		$number = Input::get("number");
		return View::make("manager", array("message" => $date));

	}

	public function getDailySalesReport(){
	}






}