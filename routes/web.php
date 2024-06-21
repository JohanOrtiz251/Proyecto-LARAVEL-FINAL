<?php

use App\Http\Controllers\Auth\LogeController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentasController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación y registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de autenticación
Route::get('/login', [LogeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LogeController::class, 'login'])->name('login.post');
Route::post('/logout', [LogeController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación y verificación (Sanctum)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard principal después de iniciar sesión
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    

    // Rutas específicas para VentasController
    Route::get('/ventas/listaventas', [VentasController::class, 'listaventas'])->name('ventas.listaventas');
    Route::get('/ventas/{id}', [VentasController::class, 'show'])->name('ventas.show');
    Route::get('/ventas/{id}/descargar-factura', [VentasController::class, 'descargarFactura'])->name('ventas.descargar-factura');

  
    //rutas de empleados
    
    Route::get('/empleado/dashboard', function () {
        return view('empleado/dashboard_empleado');
    })->name('empleado');

    
    Route::get('/empleado/productos', [ProductController::class, 'index_empleados'])->name('empleado-productos');





    // Rutas de recursos
    Route::resource('products', ProductController::class);
    Route::resource('ventas', VentasController::class); // Solo las rutas necesarias para 'ventas'
    Route::resource('suppliers', SupplierController::class);
    Route::resource('categorys', CategoryController::class);

    // Rutas para roles específicos
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
