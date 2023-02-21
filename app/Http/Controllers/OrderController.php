<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\ShopingCart;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;
use Response;
use App\Services\Midtrans\CallbackService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $order=Order::with('user')->get();
       
       return view('order.index',['orders'=>$order]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail($id){
        $data=Order::where('id',$id)->with('user')->with('Detail')->get();
        $tproduk=Order_detail::where('order_id',$id)->count('product_id');
        $titem=Order_detail::where('order_id',$id)->sum('quantity');

        return view('order.detail',['order'=>$data,'titem'=>$titem,'tproduk'=>$tproduk]);
    }
    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'total_price' => $request->recaptotal,
            'processed' => false,
            'payment_type' => null,
            'transaction_status' => null,
            'payment_url' => null,
            'transaction_time' => null,
            'settlement_time' => null,
            'delivery_status' => 'waiting',
        ];

        try {
            $id = Order::create($data)->id;
            DB::transaction(
                function () use ($request, $id) {
                    $index = 0;

                    foreach ($request->product_id as $p) {
                        $detail = [
                            'order_id' => $id,
                            'product_id' => $request->product_id[$index],
                            'quantity' => $request->quantity[$index]
                        ];
                        Order_detail::create($detail);
                        $a=ShopingCart::where('product_id', $request->product_id[$index])->where('user_id', Auth::user()->id)->delete();
                        $index++;
                    }
                }
            );
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect(route('order.show', ['order' => $id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
       
        $order = Order::find($order->id);
        $tproduk=Order_detail::where('order_id', $order->id)->count('product_id');
        $titem= Order_detail::where('order_id', $order->id)->sum('quantity');
        $detail = Order_detail::where('order_id', $order->id)->with('showproduct')->get();
        $snapToken = $order->snap_token;
        if (empty($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();
            $order->token = $snapToken;
            $order->save();
        }

        return view('user.checkout', compact('order', 'snapToken'), ['details' => $detail, 'order' => $order,'titem'=>$titem, 'tproduk' => $tproduk]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function payment(Request $request)
    {

        $serverkey =  config('midtrans.server_key');
        $order = Order::find($request->order_id);


        $hash  = hash("sha512", @$order->id . $request->status_code . $request->gross_amount . $serverkey);
        abort_if($hash != $request->signature_key, 422, 'Invalid!'); //validating request
        $data = [
            'transaction_time' => $request->transaction_time,
            'transaction_status' => $request->transaction_status,
            'settlement_time' => $request->settlement_time,
            'payment_type' => $request->payment_type,
            'delivery_status' => 'packing',
        ];
        $result = $order->update($data);
        $order->update(['processed' => true]); //set processed true
        return redirect(route('invoice', ['order' => $request->order_id]));
    }
    public function history(Request $request)
    {
        
        $order = Order::with('detail')->where('user_id', Auth::user()->id)
        ->when($request->has('process'), function ($query) use ($request) {
            $query->where('processed', $request->process);
        })->get();
        return view('user.history', array('orders' => $order));
    }
    public function invoice(Request $request)
    {
        $order = Order::find($request->order);
        $titem= Order_detail::where('order_id', $order->id)->sum('quantity');
        $tproduk=Order_detail::where('order_id', $order->id)->count('product_id');
        $detail = Order_detail::where('order_id', $order->id)->with('showproduct')->get();
        return view('user.invoice', ['order' => $order, 'details' => $detail, 'tproduk'=>$tproduk,'titem'=>$titem]);
    }
    public function status(Request $request,$id) {
        
        Order::find($id)->update(['delivery_status'=>$request->delivery_status]);
        $data= Order::find($id)->delivery_status;
        return Response::json($data);
    }
}