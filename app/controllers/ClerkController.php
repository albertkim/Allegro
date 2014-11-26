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
		$refundInfo = array(
						'receiptId' => Input::get('receiptId')
		);

		//verify the receipt is valid

		$query = DB::table('orders')
						->where('receiptId', $refundInfo['receiptId'])
						->get();		

			// verify it date was not more than 15 days ago
			if(count($query) > 0){
		
				$query2 = DB::table('orders')
								->where('receiptId', $refundInfo["receiptId"])
								->whereBetween('date', array(Carbon::now()->subdays(15), Carbon::now()))
								->get();


				//check if receipt is in Refund table
				if (count($query2) > 0){


					$query3 = DB::table('return_back')
										->where('receiptId', $refundInfo["receiptId"])
										->get();

					if(count($query3) == 0){


						$timestamp = date('Y-m-d');

						DB::table('return_back')->insert(
							array(
								'retid' => '2',
								'date' => $timestamp,
								'receiptId' =>  $refundInfo["receiptId"]
								)
							);

							// get the item purchased from refund
				
							$purchase = DB::table('purchaseitem')
								->where('receiptID',  $refundInfo["receiptId"])
								->get();

							$qty = $purchase[0]->quantity;
							$upc = $purchase[0]->upc;

							// add to returnitem table
							DB::table('returnitem')->insert(
								array(
									'retid' => '2',
									'upc' => $upc,
									'quantity' => $qty
									)
								);

							// update the stock
							DB::table('item')
									->where('upc', $upc)
									->update(array('stock' => 'stock' + $qty));

						return View::make("clerk", array("message" => "Refund is successful."));

					}
					else{
						return View::make("clerk", array("message" => "Item already has been refunded!"));
						}
					
				}
				else{
						return View::make("clerk", array("message" => "Purchase was made more than 15 days ago. Not valid for return."));
					}
			}
			else{
				return View::make("clerk", array("message" => "There is no purchase with this receipt Id."));
			}
		
	}
}