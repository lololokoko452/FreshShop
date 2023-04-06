<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
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

    Route::group([
        "prefix" => "category",
        "as" => "category."
    ], function (){
        Route::get('/index', [CategoryController::class, 'index'])->name('index');
        Route::get('/new', [CategoryController::class, 'new'])->name('new');
    });

    Route::group([
        "prefix" => "slider",
        "as" => "slider."
    ], function (){
        Route::get('/index', [SliderController::class, 'index'])->name('index');
        Route::get('/new', [SliderController::class, 'new'])->name('new');
    });

    Route::group([
        "prefix" => "slider",
        "as" => "slider."
    ], function (){
        Route::get('/index', [SliderController::class, 'index'])->name('index');
        Route::get('/new', [SliderController::class, 'new'])->name('new');
    });

    Route::group([
        "prefix" => "product",
        "as" => "product."
    ], function (){
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/new', [ProductController::class, 'new'])->name('new');
    });

    Route::group([
        "prefix" => "order",
        "as" => "order."
    ], function (){
        Route::get('/index', [OrderController::class, 'index'])->name('index');
    });
});
