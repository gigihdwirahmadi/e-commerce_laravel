<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product_image;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'description',
        'stock',
        'unit',
        'weight',
        'price',
        'category_id',
        'is_active'
    ];
    public function Categories(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function Image(){
        return $this->hasMany(Product_image::class);
    }
    public function Imageprimary(){
        return $this->hasMany(Product_image::class)->where('is_primary',1);
    }
    public function primaryimage(){
        return $this->hasOne(Product_image::class)->where('is_primary',1)->limit(1);
    }
}