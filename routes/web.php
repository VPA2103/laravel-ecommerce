<?php

use App\Http\Controllers\AdminController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\WishlistController;

Auth::routes();

Route::controller(GoogleController::class)->group(function () {
     Route::get('/auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
     Route::get('/auth/{provider}/callback', 'socialAuthentication')->name('auth.callback');
});
// Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('auth.facebook');
// Route::get('/auth/facebook-callback', [FacebookController::class, 'facebookauthentication'])->name('auth.facebook-callback');




Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('cart/inscrease-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.inscrease');
Route::put('cart/descrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
Route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');

Route::post('/wishlist/add',[WishlistController::class,'add_to_wishlist'])->name('wishlist.add');
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.index');
Route::delete('/wishlist/item/remove/{rowId}',[WishlistController::class, 'remove_item'])->name('wishlist.item.remove');
Route::delete('/Wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.item.clear');




Route::get('wishlist',[WishlistController::class,'index'])->name('wishlist.index');
Route::post('/wishlist/move-to-cart/{rowId}',[WishlistController::class,'move_to_cart'])->name('wishlist.move.to.cart');

Route::middleware(['auth'])->group(function () {
     Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
     Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
     Route::get('/admin/brand/add', [AdminController::class, 'add_brand'])->name('admin.brand.add');
     Route::post('/admin/brand/store', [AdminController::class, 'brand_store'])->name('admin.brand.store');
     Route::get('/admin/brand/edit/{id}', [AdminController::class, 'brand_edit'])->name('admin.brand.edit');
     Route::post('/admin/brand/update', [AdminController::class, 'brand_update'])->name('admin.brand.update');
     Route::delete('/admin/brand/delete/{id}', [AdminController::class, 'brand_delete'])->name('admin.brand.delete');

     Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
     Route::get('/admin/category/add', [AdminController::class, 'add_category'])->name('admin.category.add');
     Route::post('/admin/category/store', [AdminController::class, 'category_store'])->name('admin.category.store');
     Route::get('/admin/category/edit/{id}', [AdminController::class, 'category_edit'])->name('admin.category.edit');
     Route::post('/admin/category/update', [AdminController::class, 'category_update'])->name('admin.category.update');
     Route::delete('/admin/category/delete/{id}', [AdminController::class, 'category_delete'])->name('admin.category.delete');

     Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
     Route::get('/admin/product/add', [AdminController::class, 'product_add'])->name('admin.product.add');
     Route::post('/admin/product/store', [AdminController::class, 'product_store'])->name('admin.product.store');
     Route::delete('/admin/product/delete/{id}', [AdminController::class, 'product_delete'])->name('admin.product.delete');
     Route::get('/admin/product/{id}/edit', [AdminController::class, 'product_edit'])->name('admin.product.edit');
     Route::put('/admin/product/update', [AdminController::class, 'product_update'])->name('admin.product_update');

     Route::get('/admin.coupons',[AdminController::class,'coupons'])->name('admin.coupons');
     Route::get('/admin/coupon/add', [AdminController::class, 'coupon_add'])->name('admin.coupon-add');
     Route::post('/admin/coupon/store', [AdminController::class, 'coupon_store'])->name('admin.coupon.store');
     Route::get('/admin/coupon/{id}/edit', [AdminController::class, 'coupon_edit'])->name('admin.coupon.edit');
     Route::put('/admin/coupon/update', [AdminController::class, 'coupon_update'])->name('admin.coupon.update');
     Route::delete('/admin/coupon/{id}/delete',[AdminController::class, 'coupon_delete'])->name('admin.coupon.delete');
});
