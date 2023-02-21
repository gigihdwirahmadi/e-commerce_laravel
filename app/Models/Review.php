<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded=[
      
    ];
   public function users(){
    return $this->belongsTo(User::class,'user_id','id');
   }
}