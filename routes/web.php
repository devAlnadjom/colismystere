<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;

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

Route::post('/shop/purchase', [UserController::class, 'purchase'])->name('order.purchase');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/cart/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('/cart', [CartController::class, 'index'])->name('cart.show');

Route::get('/order/sumary',[ShopController::class, 'sumary'] )->name('order.sumary');
Route::get('/order/checkout',[ShopController::class, 'checkout'] )->name('order.checkout');
Route::post('/order/step2',[ShopController::class, 'storeRecipient'] )->name('store.recipient');
Route::get('/order/step2',[ShopController::class, 'step2'] )->name('order.recipient');
Route::get('/product/{slug}/{id}',[ShopController::class, 'viewone'] )->name('product.view');

Route::get('/', [ShopController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('about', function () {
        return Inertia::render('About');
    })->name('about');

    Route::resource('order', OrderController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');


    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
