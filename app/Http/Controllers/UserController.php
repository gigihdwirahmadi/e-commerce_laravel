<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Product_image;

class UserController extends Controller
{
    public function dashboard(){
       $result=Category::with('products')->limit(3)->get();
       $data = Product::select("*")
       ->with('Categories:id,name')
       ->with('primaryimage')
       ->get();
       return view('dashboard',['table' => $data->where('category_id','1')]);
    }
    public function all(request $request){
        $category= Category::get();
        $data = Product::select("*")
        ->with('Categories:id,name')
        ->when($request->has('category'), function ($query) use ($request) {
            $query->where ('category_id', $request->category);
        })
        ->with('Imageprimary')
        ->when($request->has('src'), function ($query) use ($request) {
            $query->where ('name', 'like', "%" . $request->src. "%");
        })
        ->get();
        return view('user.allproduct',['products' => $data,'category' => $category]);
    }
    public function detail($id){
        $data = Product::find($id);
        $review= Review::where('product_id',$id)->with('users')->get();
        return view('user.detail',['product' => $data,'review' => $review]);
    }
}