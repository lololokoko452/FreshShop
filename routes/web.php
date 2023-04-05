<?php

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
Route::group([
        "as" => "client."
    ], function (){
        Route::get('/', [ClientController::class, 'home'])->name('home');
        Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
        Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
        Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
        Route::get('/register', [ClientController::class, 'register'])->name('register');
        Route::get('/signin', [ClientController::class, 'signin'])->name('signin');
});
