<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/en');

Route::prefix('{locale}')->where(['locale' => 'en|ru|de'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::post('/diagnostics', [IndexController::class, 'execute'])->name('system.diagnostics');
    Route::post('/system/clear', [IndexController::class, 'clear'])->name('system.clear');
    Route::resource('posts', PostController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';

Route::get('/switch-locale/{locale}', [LocaleController::class, 'switch'])
    ->name('locale.switch')
    ->where('locale', 'en|ru|de');