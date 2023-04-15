<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
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
    Route::get('/register', [ClientController::class, 'register'])->name('register');
    Route::get('/signin', [ClientController::class, 'signin'])->name('signin');
    Route::post('/createAccount', [ClientController::class, 'createAccount'])->name('createAccount');
    Route::post('/accessAccount', [ClientController::class, 'accessAccount'])->name('accessAccount');
    Route::get('/logout', [ClientController::class, 'logout'])->name('logout');

    Route::group([
            "prefix" => "cart",
            "as" => "cart."
        ], function (){
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
            Route::get('/add/{product}', [CartController::class, 'add'])->name('add');
            Route::put('/updateQty/{product}', [CartController::class, 'updateQty'])->name('updateQty');
            Route::get('/removeItem/{product}', [CartController::class, 'removeItem'])->name('removeItem');
            Route::post('/pay', [CartController::class, 'pay'])->name('pay');
    });
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
        Route::get('/form', [CategoryController::class, 'form'])->name('new');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/form/{category}', [CategoryController::class, 'form'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{category}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::group([
        "prefix" => "slider",
        "as" => "slider."
    ], function (){
        Route::get('/index', [SliderController::class, 'index'])->name('index');
        Route::get('/form', [SliderController::class, 'form'])->name('new');
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/form/{slider}', [SliderController::class, 'form'])->name('edit');
        Route::put('/update/{slider}', [SliderController::class, 'update'])->name('update');
        Route::get('/status/{slider}', [SliderController::class, 'status'])->name('status');
        Route::get('/delete/{slider}', [SliderController::class, 'delete'])->name('delete');

    });

    Route::group([
        "prefix" => "product",
        "as" => "product."
    ], function (){
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/form', [ProductController::class, 'form'])->name('new');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/form/{product}', [ProductController::class, 'form'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::group([
        "prefix" => "order",
        "as" => "order."
    ], function (){
        Route::get('/index', [OrderController::class, 'index'])->name('index');
        Route::get('/show/{order}', [OrderController::class, 'show'])->name('show');
    });
});
