<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $fillable=[
            'order_id' ,
            'product_id',
            'quantity' ,
            'totalprice',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function showproduct(){
        return $this->belongsTo(Product::class,'product_id','id')->join('product_image','product_image.product_id','products.id')->where('product_image.is_primary', 1);
    }
}