<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('/en');
});

Route::post('/execute', [IndexController::class, 'execute'])->name('index.execute');
Route::post('/system/clear', [IndexController::class, 'clear'])->name('system.clear');

Route::middleware(['locale.validation'])->group(function () {
    Route::get('/{locale}', [IndexController::class, 'index'])
        ->where('locale', 'en|ru|de')
        ->name('home');
    
    Route::get('/{locale}/products', [ProductController::class, 'index'])
        ->where('locale', 'en|ru|de')
        ->name('products.index');
    
    Route::get('/{locale}/posts', [PostController::class, 'index'])
        ->where('locale', 'en|ru|de')
        ->name('posts.index');
    
    Route::get('/{locale}/posts/create', [PostController::class, 'create'])
        ->where('locale', 'en|ru|de')
        ->name('posts.create');
});

Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return "Success: " . Artisan::output();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});