<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/create', [
    ProductController::class,
    'create'
])->name('products.create');
Route::get('/welcome', [
    ProductController::class,
    'index'
])->name('welcome');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [
    ProductController::class,
    'destroy'
])->name('products.destroy');
