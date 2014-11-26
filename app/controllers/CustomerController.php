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
		if(isset($albums)){
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
		}
		
		return View::make("customer");
	}

	public function getItems(){
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
		return json_encode($albums);
	}

	public function getPurchasedItems(){
		$purchases = array();
		$purchases = DB::transaction(function() use ($purchases){
			$orders = DB::table("Orders")->where("cid", Auth::user()->id)->get();
			foreach($orders as $order){
				$orderPurchases = DB::table("PurchaseItem")->where("receiptId", $order->id)->get();
				$purchases = array_merge($purchases, $orderPurchases);
			}
			return $purchases;
		});

		foreach($purchases as $purchase){
			$title = DB::table("Item")->where("upc", $purchase->upc)->pluck("title");
			// add title to $purchase object
			$purchase->title = $title;
		}

		$purchases = json_encode($purchases);
		return $purchases;
	}

	public function searchItem() {


		$searchInfo = array(
						'category' => Input::get('categoryInput'),
						'title'    => Input::get('titleInput'),
						'artist'   => Input::get('artistInput'),

		);

			$item = DB::table('item')
					->where('category', 'LIKE', $searchInfo['category'])
					->where('title', 'LIKE', $searchInfo['title'])
					->where('artist', 'LIKE', $searchInfo['artist'])
					->get();





		if(isset($songs)){
			// only category
				$item = DB::table('item')
					->where('category', $category)
					->get();
		}
		else{
			
		}
		//only title
		DB::transaction(function(){
						$item = DB::table('item')
								->where('title', $title)
								->get();
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
				
		});
		// category and title
		DB::transaction(function(){
						$item = DB::table('item')
								->where('title', $title)
								->where('category', $category)
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

	public function buyItems(){
		$order = file_get_contents("php://input");
		$order = json_decode($order, true);

		DB::transaction(function() use ($order){

			$orderId = DB::table("Orders")->insertGetId(array(
				"cid" => Auth::user()->id,
				"date" => date('Y/m/d H:i:s'),
				"card_num" => $order["card_num"],
				"expiryDate" => DateTime::createFromFormat('Y-m-d', $order["expiryDate"]),
				"deliveredDate" => DateTime::createFromFormat('Y-m-d', $order["deliveredDate"])
			));

			foreach($order["items"] as $item){
				DB::table("PurchaseItem")->insert(array(
					"receiptId" => $orderId,
					"upc" => $item["upc"],
					"quantity" => $item["quantity"]
				));
			}

		});

		return "Successfully purchased items";
	}

}