<?php

use App\Http\Controllers\cartcontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\wishlistcontroller;
use App\Http\Middleware\cartquantity;
use App\Http\Middleware\userauth;
use Illuminate\Support\Facades\Route;

Route::middleware([userauth::class])->group(function () {
    Route::get('/cart', [cartcontroller::class, 'index']);
    Route::post('/cart/add', [cartcontroller::class, 'cartadd'])->name('cart.add');
    Route::post('/cart/item-increase', [cartcontroller::class, 'itemincrease'])->name('cart.itemincrease');
    Route::post('/cart/item-decrease', [cartcontroller::class, 'itemdecrease'])->name('cart.itemdecrease');
    Route::post('/cart/item-remove', [cartcontroller::class, 'itemremove'])->name('cart.itemremove');
    Route::post('/cart/empty', [cartcontroller::class, 'cartempty'])->name('cart.cartempty');
    Route::get('/wishlist', [wishlistcontroller::class, 'index']);
    Route::post('/wishlist/add', [wishlistcontroller::class, 'addtowishlist'])->name('wishlist.add');
    Route::post('/wishlist/item-increase', [wishlistcontroller::class, 'wishlistincrease'])->name('wishlist.itemincrease');
    Route::post('/wishlist/item-decrease', [wishlistcontroller::class, 'wishlistdecrease'])->name('wishlist.itemdecrease');
    Route::post('/wishlist/remove', [wishlistcontroller::class, 'removefromwishlist'])->name('wishlist.remove');
    Route::post('/wishlist/empty', [wishlistcontroller::class, 'wishlistempty'])->name('wishlist.empty');
    Route::post('/cart/coupon/apply', [cartcontroller::class, 'couponapply'])->name('coupon.apply');
    Route::post('/cart/coupon/remove', [cartcontroller::class, 'removecoupon'])->name('coupon.remove');

    Route::get('/dashboard', [usercontroller::class, 'index'])->name('users.dashboard');
    Route::get('/account-orders', [usercontroller::class, 'accountorders'])->name('users.account-orders');
    Route::get('/account-order-detail/{id}', [usercontroller::class, 'orderdetails'])->name('users.account-order-detail');
    Route::post('/cancel-order', [usercontroller::class, 'cancelorder'])->name('users.cancel-order');
    Route::get('/account-address', [usercontroller::class, 'accountaddress'])->name('users.account-address');
    Route::get('/account-addaddress', [usercontroller::class, 'addaddress'])->name('users.account-address-add');
    Route::post('/account-storeaddress', [usercontroller::class, 'storeaddress'])->name('users.account-address-store');
    Route::get('/account-editaddress', [usercontroller::class, 'editaddress'])->name('users.account-address-edit');
    Route::post('/account-updateaddress', [usercontroller::class, 'updateaddress'])->name('users.account-address-update');
    Route::get('/account-details', [usercontroller::class, 'accountdetails'])->name('users.account-details');
    Route::post('/account-details-change', [usercontroller::class, 'accountdetailschange'])->name('users.account-details-change');
    Route::match(['get', 'post'], '/cart/order-confirmation/{id}', [cartcontroller::class, 'order_confirmation'])->name('cart.confirmation');
    // Route::get('/cart/order-confirmation/{id?}', [cartcontroller::class, 'order_confirmation'])->name('cart.confirmation')->middleware(routeid::class);->middleware(routeid::class)
});

Route::middleware([cartquantity::class, userauth::class])->group(function () {
    Route::get('/cart/checkout', [cartcontroller::class, 'checkout']);
    Route::post('/cart/checkout/place-order', [cartcontroller::class, 'placeorder'])->name('cart.place-order');
    Route::match(['get', 'post'], '/phonepe/callback', [cartcontroller::class, 'phonePeCallback'])->name('phonepe.callback');
});
