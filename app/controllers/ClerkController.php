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

	public function checkRefund() 
	{
		$receiptId = file_get_contents("php://input");
		$receiptId = json_decode($receiptId, true);

		$timestamp = date('Y-m-d');

		//verify the receipt is valid

		DB::transaction(function(){
			$query = DB::table('Order')
							->where('receiptId', '=', $receiptId)
							-> get();
		});

		// verify it date was not more than 15 days ago
		
		if(!$query){

			$fifteenDaysAgo = Carbon::now()->subdays(15);

			DB::transaction(function(){
			$query2 = DB::table('orders')
							->where('receiptId', $receiptId)
							->where('date', '>=', $fifteenDaysAgo)
							-> get();
		});


			//check if receipt is in Refund table
			if (!$query2){

				Db::transaction(function(){
				$query3 = DB::table('refund_back')
									->where('receiptId', '=', $receiptId)
									->get();
				});

				if(!$query3){

					DB::transaction(function(){
						DB::table('refund_back')->insert(
							array(
								'retid' => '1',
								'date' => $timestamp,
								'receiptId' => $receiptId
								)
						);
				});

				// update the stock
		
				DB::transaction(function(){
					$purchase = DB::table('purchaseitem')
							->where('receiptID', $receiptId)
							->get();

					$qty = var_dump($purchase->qty);
					$upc = var_dump($purchase->upc);

					$item = DB::table('item')
							->where('upc', $upc)
							->get();


					DB::table('item')
							->increment('stock', $qty, 	
								array('upc' => $upc));
						});
				}
				else{
					Session::flash('refundedMsg', "You have already refunded this item.");
					return Redirect::back();
				}
			}
			else{
				Session::flash('daysMsg', "You cannot refund an item that was purchased more than 15 days ago.");
				return Redirect::back();
			}
			
		}
		else{
			Session::flash('receiptMsg', "Receipt Id is not valid. Please try again.");
			return Redirect::back();
		}
	}


}