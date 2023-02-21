<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShopingCart;

use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService; 

use App\Models\Product;
use Response;
use App\Models\ShoppingCart;
class ShopingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $carts=ShopingCart::where('user_id', Auth::user()->id)->with('products')->get();
        return view('user.cart',['carts' => $carts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $cart= ShopingCart::where('product_id', $request->product_id)->where('user_id',Auth::user()->id)->get();
            if($cart->isEmpty()){
            ShopingCart::create([
            "user_id"=>Auth::user()->id,
            "product_id"=>$request->product_id,
<<<<<<< HEAD
            "quantity"=>$request->quantity 
            ]);} else {
            $quantity = $cart[0]->quantity+$request->quantity;
            $data=['quantity'=>$quantity];
            ShopingCart::find($cart[0]->id)->update($data);
          
        };
=======
            "quantity"=>$request->quantity
        ]);
        //belum ada validasi klo dia input produk yang sama
>>>>>>> 80733d901ab9e43fadc526d2a92d1611bff93ba8
        return redirect(route('all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Order::find($id)-
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            "quantity" => $request->quantity
        ];
        ShopingCart::find($id)->update($data);
        $data= ShopingCart::where('id',$id)->with('products')->get();
        return Response::json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ShopingCart::where('id',$id)->delete();
        return redirect(route('cart.index'));
}
}
