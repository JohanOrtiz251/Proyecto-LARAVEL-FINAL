<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    Route::resource('products', ProductController::class);

    Route::resource('ventas', VentasController::class);
});




