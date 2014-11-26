<?php

class CustomerController extends BaseController {

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
		log::info("Current user: ");
		log::info( Cookie::get("user"));
		$albums = DB::table("item")->get();

		// get all related data to albums, add to album objects
		foreach($albums as $album){
			$id = intval($album->upc);
			$leadSinger = DB::table("leadSinger")->where("upc", $id)->first();
			$songs = DB::table("hasSong")->where("upc", $id)->get();

			// if exists
			if(isset($leadSinger->name)){
				$album->leadSinger = $leadSinger->name;
			} else{
				$album->leadSinger = "None";
			}

			if(isset($songs)){
				$album->songs = $songs;
			} else{
				$album->songs = array();
			}
		}
		
		return View::make("customer", array(
			"albums" => $albums,
		));
	}

	public function searchItem(){

		$searchInfo = array(
						'category' => Input::get('categoryInput'),
						'title' => Input::get('titleInput'),
						'artist' => Input::get('artistInput'),
						'quantity' => Input::get('quantityInput')
		);

		DB::transaction(function() use ($searchInfo){
						$item = DB::table('item')
								->where('category', $searchInfo["category"])
								->get();

				

		});

		//only title

		DB::transaction(function() use ($searchInfo){
						$item = DB::table('item')
								->where('title', $searchInfo["title"])
								->get();

		});

		//only leading singer

		DB::transaction(function() use ($searchInfo){
						$singer = DB::table('leadsinger')
								->where('name', $searchInfo["artist"])
								->get();

			$upc = var_dump($singer->upc);

						$item = DB::table('item')
								->where('upc', $upc)
								->get();

				
		});

		// category and title

		DB::transaction(function() use ($searchInfo) {
						$item = DB::table('item')
								->where('title', $searchInfo["title"])
								->where('category', $searchInfo["category"])
								->get();

				
		});

		// category and singer

		DB::transaction(function(){
						$item = DB::table('item')
								->where('category', $category)
								->get();

		});

		// title and singer
		DB::transaction(function(){
						$singer = DB::table('leadsinger')
								->where('name', $singer)
								->get();

					$upc = var_dump($singer->upc);


						$item = DB::table('item')
								->where('upc', $upc)
								->where('title', $title)
								->get();

		});

		// category, title, and singer

		DB::transaction(function(){
						$singer = DB::table('leadsinger')
								->where('name', $singer)
								->get();

					$upc = var_dump($singer->upc);

						$item = DB::table('item')
								->where('upc', $upc)
								->where('title', $title)
								->where('category', $category)
								->get();

		});
	}
}