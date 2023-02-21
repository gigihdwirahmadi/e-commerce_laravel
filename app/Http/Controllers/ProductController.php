<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::select("*")->with('Categories:id,name')->with('Image')->get();
        return view('product.index', ['products' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::get();
        return view('product.create', ['categories' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'sku' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'weight' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'image' => ['required'],
        ]);
        $validated['is_active'] = 1;
        try {
            DB::transaction(
                function () use ($validated, $request) {
                    $data = $validated["image"];
                    unset($validated['image']);
                    $product = Product::create($validated);
                    $insert = [];
                    $num = 0;
                    foreach ($data as $image) {
                        $path = $image->store('image', 'public');
                        if ($request->is_primary[$num] == 1) {
                            $is_primary = 1;
                        } else if ($request->is_primary[$num] == 0) {
                            $is_primary = 0;
                        }
                        $insert = [
                            'image' => $path,
                            'product_id' => $product->id,
                            'is_primary' => $is_primary,
                        ];
                        Product_image::create($insert);
                        $num++;
                    }
                }
            );
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect(Route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::get();
        $product = Product::find($id);
        return view('product.edit', ['categories' => $data, 'product' => $product]);
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

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'sku' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'weight' => ['required'],
            'price' => ['required'],
            'category_id' => ['required', 'integer']
        ]);
        $validated['image'] = $request->image;
        $validated['is_active'] = 1;
        try {
            DB::transaction(
                function () use ($validated, $id, $request) {
                    $role_primary = 0;

                    unset($validated['image']);
                    $product = Product::find($id)->update($validated);
                    $insert = [];
                    Product_image::where('product_id', $id)->delete();
                    $num = 0;
                    //bagian data lama 
                    if ($request->data_image) {
                        $data = $request->data_image;
                        $i = 0;
                        foreach ($data as $a) {
                            $is_primary = $request->data_is_primary;
                            // if ($is_primary[$i] == 1 && $role_primary == 0) {
                            //     $role_primary++;
                            //     $is_primary[$i] = 1;
                            // } else if ($role_primary == 0) {
                            //     $is_primary[$i] = 1;
                            //     $role_primary++;
                            // } else {
                            //     $is_primary[$i] = 0;
                            // }
                            $insert = [
                                'image' => $a,
                                'product_id' => $id,
                                'is_primary' => $is_primary[$i],
                            ];

                            $i++;
                            Product_image::create($insert);
                        }
                    }
                    //bagian data yang baru

                    if ($request->image) {
                        $data = $request->image;
                        $is_primary = $request->is_primary;
                        $i = 0;
                        foreach ($data as $image) {
                            $path = $image->store('image', 'public');
                            // if ($is_primary[$i] == 1 && $role_primary == 0) {
                            //     $role_primary++;
                            //     $is_primary[$i] = 1;
                            // } else if ($role_primary == 0) {
                            //     $is_primary[$i] = 1;
                            //     $role_primary++;
                            // } else {
                            //     $is_primary[$i] = 0;
                            // }
                            $insert = [
                                'image' => $path,
                                'product_id' => $id,
                                'is_primary' => $is_primary[$i],
                            ];
                            Product_image::create($insert);
                            $i++;
                        }
                    }
                }
            );
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect(Route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product_image::where('product_id', $id)->get();
        if (Storage::delete($product[0]->image)) {
            Product_image::where('product_id', $id)->delete();
        }
        Product::find($id)->delete();
        return redirect(route('product.index'));
    }
}