<?php

namespace App\Models;
use App\Models\User;
use App\Models\Order_detail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guard=[];
    protected $fillable = [
            'user_id',
            'total_price',
            'user_id',
            'total_price',
            'processed',
            'payment_type',
            'transaction_status',
            'payment_url',
            'transaction_time',
            'settlement_time',
            'delivery_status',  
    ];
    public function Detail(){
        return $this->hasMany(Order_detail::class)->join('products','order_details.product_id','products.id')->join('product_image','product_image.product_id','products.id')->where('product_image.is_primary', 1);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}