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

	public function checkAlbumDate() 
	{
		$timestamp = date('Y-m-d');

		
		
	}

	//verify the receiptId
	public function verifyReceipt()
	{
		DB::transaction(function(){
			$query = DB::table('Order')
							->where('receiptId', '=', 'input from user')
							-> get();
		});
	}

	//check if receipt is in Refund table
	public function alreadyReturned()
	{
		Db::transaction(function(){
			$query = DB::table('Refund')
							->where('receiptId', '=', 'input from user')
							->get();
		});
	}

	// process refund
	public function processRefund()
	{
		$timestamp = date('y-m-d');

			DB::transaction(function(){
				DB::table('Refund')->insert(
					array(
						'retid' => 'auto generated id',
						'date' => $timestamp,
						'receiptId' => 'original receipt id'
						)
					);
			});
	}

	// update the stock
	public function updateStockForRefund()
	{
		DB::transaction(function(){
			$receiptID = DB::table('PurchaseItem')->where(
			'receiptID', 'user input receiptID')
			-> first();

			$qty = var_dump($stock->qty);
			$upc = var_dump($stock->upc);

			DB::table('Item')
					->where('upc', $upc)
					->update(array(
						'stock' => 'stock' + $qty)
					);
		});

	}

}