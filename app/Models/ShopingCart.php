<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class ShopingCart extends Model
{
    use HasFactory;
    protected $table="shoping_cart";
    protected $fillable = [
        'user_id', 
        'product_id',
        'quantity',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id')->join('product_image','product_image.product_id','products.id')->where('product_image.is_primary', 1);
    }
}