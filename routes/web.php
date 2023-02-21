<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopingCartController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//user
Route::get('/dashboard',  [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/all',  [UserController::class, 'all'])->name('all');

Route::get('/detail/{product}',  [UserController::class, 'detail'])->name('detail');

Route::middleware(['hasRole:user', 'auth', 'verified'])->group(function () {
    Route::resource('/cart', ShopingCartController::class);
    Route::get('history', [OrderController::class, 'history'])->name('history');
  
});
Route::get('invoice/{order}', [OrderController::class, 'invoice'])->name('invoice');
Route::resource('order', OrderController::class);
Route::get('/order/detail/{order}',  [OrderController::class, 'detail'])->name('order.detail');
Route::patch('/order/status/{order}',  [OrderController::class, 'status'])->name('order.status');

Route::resource('review', ReviewController::class);
Route::post('/payment',  [OrderController::class, 'payment'])->name('payment');

//admin
Route::middleware('hasRole:admin')->group(function () {
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
});

Route::get('/adminpage', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'hasRole:admin'])->name('admin.dashboard');

Route::get('/addadmin', function () {
    return view('admin.add');
})->middleware('hasRole:admin')->name('addadmin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //admin

    //user
});

require __DIR__ . '/auth.php';