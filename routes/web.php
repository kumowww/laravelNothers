<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('/en');
});

Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Success: " . Artisan::output();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::middleware(['locale.validation'])
    ->prefix('{locale}')
    ->where(['locale' => 'en|ru|de'])
    ->group(function () {

        Route::get('/', [IndexController::class, 'index'])->name('home');
        Route::post('/execute', [IndexController::class, 'execute'])->name('index.execute');
        Route::post('/system/clear', [IndexController::class, 'clear'])->name('system.clear');

        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    });