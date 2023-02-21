<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    use HasFactory;
    protected $table= 'product_image';
    protected $fillable = [
        'product_id',
        'image',
        'is_primary',
        
    ];
}