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

		// only category

		DB::transaction(function(){
						$item = DB::table('item')
								->where('category', $category)
								->get();

				
				checkItemExist($item);

		});

		//only title

		DB::transaction(function(){
						$item = DB::table('item')
								->where('title', $title)
								->get();

				checkItemExist($item);
		});

		//only leading singer

		DB::transaction(function(){
						$singer = DB::table('leadsinger')
								->where('name', $singer)
								->get();

			$upc = var_dump($singer->upc);

						$item = DB::table('item')
								->where('upc', $upc)
								->get();

				
				checkItemExist($item);
		});

		// category and title

		DB::transaction(function(){
						$item = DB::table('item')
								->where('title', $title)
								->where('category', $category)
								->get();

				
				checkItemExist($item);
		});

		// category and singer

		DB::transaction(function(){
						$item = DB::table('item')
								->where('category', $category)
								->get();

				checkItemExist($item);	
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

				checkItemExist($item);
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

				checkItemExist($item);
		});
	}

	public function checkItemExist($item){
		if (count($item) > 0) {
			checkStock($item);
		}
		else {
			//item does not exist message
		}
	}

	public function checkStock($item){

		$stock = var_dump($item->stock);



	}

}