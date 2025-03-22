<?php

use App\Http\Controllers\homecontroller;
use App\Http\Controllers\shopcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', [homecontroller::class, 'index']);
Route::get('/shop',[shopcontroller::class,'index'])->name('shop.index');
Route::post('/shop', [shopcontroller::class, 'sort'])->name('shop.sort');
Route::get('/product-detail/{slug}', [shopcontroller::class, 'productdetail'])->name('product.detail');
Route::get('/about', [homecontroller::class, 'about']);
Route::get('/contact', [homecontroller::class, 'contact']);
Route::post('/contact-form', [homecontroller::class, 'contactform'])->name('user.contact');
Route::get('/affiliate', [homecontroller::class, 'affiliate']);
Route::get('/privacy-policy', [homecontroller::class, 'privacypolicy']);
Route::get('/terms-conditions', [homecontroller::class, 'termscondition']);
Route::post('/validation', [homecontroller::class, 'login'])->name('dashboard.login');
Route::post('/logout', [homecontroller::class, 'logout'])->name('dashboard.logout');

require __DIR__.'/user.php';

require __DIR__.'/admin.php';
