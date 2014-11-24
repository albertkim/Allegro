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
			$album->leadSinger = $leadSinger->name;
			$album->songs = $songs;
		}
		
		return View::make("customer", array(
			"albums" => $albums,
		));
	}

}