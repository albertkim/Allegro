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
		$topItems = DB::select("SELECT I.TITLE AS title, P.UPC, SUM(QUANTITY) AS sum 
			FROM PURCHASEITEM P, ITEM I 
			WHERE P.UPC = I.UPC 
			GROUP BY P.UPC 
			ORDER BY SUM(P.QUANTITY) 
			DESC 
			LIMIT 5");

		return json_encode($topItems);
	}

	public function getTopItemsByDate(){
		log::info("POST getTopItemsByDate");
		$date = Input::get("date");
		$number = Input::get("number");

		$topItems = DB::select("SELECT i.title, i.company, i.stock, SUM(PI.QUANTITY) AS sum
						FROM Item i, PurchaseItem pi, Orders o
						WHERE o.date = ? AND o.id = pi.receiptID AND pi.upc = i.upc
						GROUP BY i.UPC
						ORDER BY SUM(PI.QUANTITY)
						DESC
						LIMIT ?", array($date, $number));

		log::info($topItems);
		return json_encode($topItems);
	}

	public function getDailySalesReport(){



	}

}