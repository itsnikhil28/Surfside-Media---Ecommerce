<?php

use App\Http\Controllers\adminbrandcontroller;
use App\Http\Controllers\admincategorycontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\admincouponcontroller;
use App\Http\Controllers\adminordercontroller;
use App\Http\Controllers\adminproductcontroller;
use App\Http\Controllers\adminsalescontroller;
use App\Http\Controllers\adminslidercontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Middleware\adminauth;
use Illuminate\Support\Facades\Route;

Route::middleware([adminauth::class])->group(function () {
    Route::get('/admin-dashboard', [admincontroller::class, 'index'])->name('admin.dashboard');
    Route::get('/chart-data', [admincontroller::class, 'getChartData']);

    Route::get('/brands', [admincontroller::class, 'brands'])->name('admin.brands');
    Route::get('/add-brand', [adminbrandcontroller::class, 'addbrand'])->name('admin.add-brand');
    Route::post('/add-brand/store', [adminbrandcontroller::class, 'brandstore'])->name('admin.brand.store');
    Route::get('/brand-edit/{id}', [adminbrandcontroller::class, 'editbrand'])->name('admin.brand.edit');
    Route::post('/brand-edit/update', [adminbrandcontroller::class, 'updatebrand'])->name('admin.brand.update');
    Route::post('/brand/delete/{id}', [adminbrandcontroller::class, 'branddelete'])->name('admin.brand.delete');

    Route::get('/categories', [admincontroller::class, 'categories'])->name('admin.categories');
    Route::get('/add-category', [admincategorycontroller::class, 'addcategory'])->name('admin.add-category');
    Route::post('/add-category/store', [admincategorycontroller::class, 'categorystore'])->name('admin.category.store');
    Route::get('/category-edit/{id}', [admincategorycontroller::class, 'editcategory'])->name('admin.category.edit');
    Route::post('/category-edit/update', [admincategorycontroller::class, 'updatecategory'])->name('admin.category.update');
    Route::post('/category/delete/{id}', [admincategorycontroller::class, 'categorydelete'])->name('admin.category.delete');

    Route::get('/products', [admincontroller::class, 'products'])->name('admin.products');
    Route::get('/add-product', [adminproductcontroller::class, 'addproduct'])->name('admin.add-product');
    Route::post('/add-product/store', [adminproductcontroller::class, 'productstore'])->name('admin.product.store');
    Route::get('/product-edit/{id}', [adminproductcontroller::class, 'editproduct'])->name('admin.product.edit');
    Route::post('/product-edit/update', [adminproductcontroller::class, 'updateproduct'])->name('admin.product.update');
    Route::post('/product/delete/{id}', [adminproductcontroller::class, 'productdelete'])->name('admin.product.delete');

    Route::get('/coupons', [admincontroller::class, 'coupons'])->name('admin.coupons');
    Route::get('/add-coupon', [admincouponcontroller::class, 'addcoupon'])->name('admin.add-coupon');
    Route::post('/add-coupon/store', [admincouponcontroller::class, 'couponstore'])->name('admin.coupon.store');
    Route::get('/coupon-edit/{id}', [admincouponcontroller::class, 'editcoupon'])->name('admin.coupon.edit');
    Route::post('/coupon-edit/update', [admincouponcontroller::class, 'updatecoupon'])->name('admin.coupon.update');
    Route::post('/coupon/delete/{id}', [admincouponcontroller::class, 'coupondelete'])->name('admin.coupon.delete');

    Route::get('/orders', [admincontroller::class, 'orders'])->name('admin.orders');
    Route::post('/order-details', [adminordercontroller::class, 'orderdetail'])->name('admin.order-detail');
    Route::get('/order-tracking', [adminordercontroller::class, 'ordertracking'])->name('admin.order.tracking');

    Route::get('/sliders', [admincontroller::class, 'sliders'])->name('admin.sliders');
    Route::get('/add-slider', [adminslidercontroller::class, 'addslider'])->name('admin.add-slider');
    Route::post('/add-slider/store', [adminslidercontroller::class, 'sliderstore'])->name('admin.slider.store');
    Route::get('/slider-edit/{id}', [adminslidercontroller::class, 'editslider'])->name('admin.slider.edit');
    Route::post('/slider-edit/update', [adminslidercontroller::class, 'updateslider'])->name('admin.slider.update');
    Route::post('/slider/delete/{id}', [adminslidercontroller::class, 'sliderdelete'])->name('admin.slider.delete');

    Route::get('/sales', [admincontroller::class, 'sales'])->name('admin.sales');
    Route::get('/add-sale', [adminsalescontroller::class, 'addsale'])->name('admin.add-sale');
    Route::get('/add-sale-product/{id}', [adminsalescontroller::class, 'productdetail'])->name('admin.add-sale-product');
    Route::post('/add-sale/store', [adminsalescontroller::class, 'salestore'])->name('admin.sale.store');
    Route::get('/sale-edit/{id}', [adminsalescontroller::class, 'editsale'])->name('admin.sale.edit');
    Route::post('/sale-edit/update', [adminsalescontroller::class, 'updatesale'])->name('admin.sale.update');
    Route::post('/sale/delete/{id}', [adminsalescontroller::class, 'saledelete'])->name('admin.sale.delete');

    Route::get('/users', [admincontroller::class, 'users'])->name('admin.users');
    Route::get('/settings', [admincontroller::class, 'settings'])->name('admin.settings');
    Route::post('/details-change', [usercontroller::class, 'accountdetailschange'])->name('admin.account-details-change');
});
