<?php

use Carbon\Carbon; 

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

		DB::transaction(function() use ($receiptId){
			$query = DB::table('orders')
							->where('receiptId', '=', $receiptId)
							-> get();


			// verify it date was not more than 15 days ago
			if(count($query) > 0){

				DB::transaction(function(){
				$query2 = DB::table('orders')
								->where('receiptId', '111')
								->where('date', '>=', Carbon::now()->subdays(15));

				//check if receipt is in Refund table
				if (count($query2) > 0){

					Db::transaction(function(){
					$query3 = DB::table('return_back')
										->where('receiptId', '=', '112')
										->get();

					if(count($query3) > 0){

						DB::transaction(function(){
							DB::table('return_back')->insert(
								array(
									'retid' => '1',
									'date' => $timestamp,
									'receiptId' => '111'
									)
							);
						});

						// update the stock
				
						DB::transaction(function(){
							$purchase = DB::table('purchaseitem')
									->where('receiptID', '111')
									->get();

							$qty = var_dump($purchase->qty);
							$upc = var_dump($purchase->upc);

							$item = DB::table('item')
									->where('upc', $upc)
									->get();


							DB::table('item')
									->increment('stock', $qty, 	
										array('upc' => $upc));

							// add to returnitem table
							DB::table('returnitem')->insert(
								array(
									'retid' => '1',
									'upc' => $upc,
									quantity => $qty
									)
								);
							});

					}
					else{
						//Session::flash('refundedMsg', "You have already refunded this item.");
						//return Redirect::to('checkRefund', )
						//return Redirect::to('checkRefund')->with('message', 'test2');
						return View::make("clerk", array("message" => "Passwords do not match"));
						}
					});
				}
				else{
						//Session::flash('daysMsg', "You cannot refund an item that was purchased more than 15 days ago.");
						//return Redirect::to('checkRefund')->with('message', 'test3');
						return View::make("clerk", array("message" => "Passwords do not match"));
					}
				});
			}
			else{
				//Session::flash('receiptMsg', "Receipt Id is not valid. Please try again.");
				//return Redirect::to('checkRefund')->with('message', 'test3');
				return View::make("clerk", array("message" => "Passwords do not match"));
			}
			
		//return Redirect::to('checkRefund')->with('message', 'test4');
		return View::make("clerk", array("message" => "Passwords do not match"));
		});
		
	}
}