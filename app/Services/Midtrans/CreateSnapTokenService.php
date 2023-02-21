<?php

namespace App\Services\Midtrans;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
	protected $order;

	public function __construct($order)
	{
		parent::__construct();

		$this->order = $order;
	}

	public function getSnapToken()
	{
        $data= Order::find($this->order);
		$params = [
			'transaction_details' => [
				'order_id' => $data[0]->id,
				'gross_amount' => $data[0]->total_price,
			],
			// 'item_details' => [
			// 	[
			// 		'id' => 1,
			// 		'price' => '150000',
			// 		'quantity' => 1,
			// 		'name' => 'Flashdisk Toshiba 32GB',
			// 	],
			// 	[
			// 		'id' => 2,
			// 		'price' => '60000',
			// 		'quantity' => 2,
			// 		'name' => 'Memory Card VGEN 4GB',
			// 	],
			// ],
			'customer_details' => [
				'first_name' => Auth::user()->name,
				'email' => Auth::user()->email,
				'phone' => @Auth::user()->phone,
			]
		];
        $index=0;
        $detail= Order_detail::where('order_id',$data[0]->id)->with('products')->get();
        foreach( $detail as $d){
			$params['item_details'][$index]['id'] = $d->products->id;
			$params['item_details'][$index]['price'] = $d->products->price;
			$params['item_details'][$index]['quantity'] = $d->quantity;
			$params['item_details'][$index]['name'] = $d->products->name;
			$index++;
		}
		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}