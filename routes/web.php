<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route to display the product creation form
Route::get('/product', [ProductController::class, 'create'])->name('product.create');

// Route to handle the form submission
Route::post('/product', [ProductController::class, 'store'])->name('product.store');

Route::get('/product/edit/{index}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{index}', [ProductController::class, 'update'])->name('product.update');