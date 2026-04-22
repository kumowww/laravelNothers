<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')->where(['locale' => 'en|ru|de'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::post('/diagnostics', [IndexController::class, 'diagnostics'])->name('system.diagnostics');
    Route::post('/system/clear', [IndexController::class, 'clear'])->name('system.clear');
    Route::resource('posts', PostController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/switch-locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch')
    ->where('locale', 'en|ru|de');