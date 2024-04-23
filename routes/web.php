<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'products'], function () {
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/import/products', [ProductController::class, 'importPage'])->name('products.import');
    Route::post('/uploadExcel', [ProductController::class, 'uploadExcel'])->name('products.uploadExcel');
    Route::post('/upload/image/{product}', [ProductController::class, 'uploadImage'])->name('products.uploadImage');
});
