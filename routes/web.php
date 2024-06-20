<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas específicas para VentasController
    Route::get('/ventas/listaventas', [VentasController::class, 'listaventas'])->name('ventas.listaventas');
    Route::get('/ventas/{id}', [VentasController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/{id}/descargar-factura', [VentasController::class, 'descargarFactura'])->name('ventas.descargar-factura');

    // Rutas de recursos
    Route::resource('products', ProductController::class);
    Route::resource('ventas', VentasController::class); // Aquí incluyes solo las rutas necesarias para 'ventas'
    Route::resource('suppliers', SupplierController::class);
    Route::resource('categorys', CategoryController::class);

    // Rutas para admin y empleado con middleware de roles
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');
    });

    Route::middleware('role:employee')->group(function () {
        Route::get('/employee/dashboard', function () {
            return view('empleado.dashboard_empleado');
        })->name('employee.dashboard');
    });
});