<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocaleController;

Route::get('/', function () {
    return redirect('/en');
});

Route::middleware(['locale.validation'])
    ->prefix('{locale}')
    ->where(['locale' => 'en|ru|de'])
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('home');
        Route::post('/execute', [IndexController::class, 'execute'])->name('index.execute');
        Route::post('/system/clear', [IndexController::class, 'clear'])->name('system.clear');
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    });

Route::get('/switch-locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch')
    ->where('locale', 'en|ru|de');