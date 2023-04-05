<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Client Controller
Route::group([
        "as" => "client.",
    ], function (){
        Route::get('/', [ClientController::class, 'home'])->name('home');
        Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
        Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
        Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
        Route::get('/register', [ClientController::class, 'register'])->name('register');
        Route::get('/signin', [ClientController::class, 'signin'])->name('signin');
});


//Admin Controller
Route::group([
    "prefix" => "admin",
    "as" => "admin."
], function (){
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::get('/addSlider', [AdminController::class, 'addSlider'])->name('addSlider');
    Route::get('/sliders', [AdminController::class, 'sliders'])->name('sliders');
    Route::get('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
});
