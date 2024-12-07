<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;

// Pages
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart');
Route::get('/redirect', [RedirectController::class, '__invoke']);
Route::get('/product/new', [PagesController::class, 'createform'])->name('product.createform');  


// Product CRUD
Route::get('/shop', [ProductController::class, 'getAllProducts'])->name('shop');  
Route::get('/product/{id}', [ProductController::class, 'getProduct'])->name('product.show');
Route::get('/product/{id}/edit', [ProductController::class, 'editProduct'])->name('product.edit');

Route::post('/product/created', [ProductController::class, 'store'])->name('product.store');  
Route::put('/product/{id}/update', [ProductController::class, 'updateProduct'])->name('product.update');
Route::delete('/product/{id}/delete', [ProductController::class, 'deleteProduct'])->name('product.delete');
