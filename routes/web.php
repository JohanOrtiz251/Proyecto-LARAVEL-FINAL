<?php

use App\Http\Controllers\AuditController;
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
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/login', [LogeController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LogeController::class, 'login'])->name('login.post');
});

// Rutas protegidas por autenticación y verificación (Sanctum)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Dashboard principal después de iniciar sesión
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas específicas para VentasController
    Route::prefix('ventas')->group(function () {
        Route::get('/listaventas', [VentasController::class, 'listaventas'])->name('ventas.listaventas');
        Route::get('/{id}', [VentasController::class, 'show'])->name('ventas.show');
        Route::get('/{id}/descargar-factura', [VentasController::class, 'descargarFactura'])->name('ventas.descargar-factura');
    });

    // Rutas para empleados
    Route::middleware('role:employee')->group(function () {
        Route::prefix('empleado')->group(function () {
            Route::get('/dashboard', function () {
                return view('empleado.dashboard_empleado');
            })->name('empleado.dashboard');

            // Rutas de productos para empleados
            Route::prefix('productos')->group(function () {
                Route::get('/', [ProductController::class, 'index_empleados'])->name('empleado-productos');
                Route::get('/crear', [ProductController::class, 'create_empleado'])->name('crear_producto');
                Route::post('/', [ProductController::class, 'store_empleado'])->name('productos.store');
                Route::get('/{product}', [ProductController::class, 'show_empleado'])->name('show_empleado');
                Route::get('/{product}/editar', [ProductController::class, 'edit_empleado'])->name('empleado.products.edit');
                Route::put('/{product}', [ProductController::class, 'update_empleado'])->name('empleado.products.update');
                Route::delete('/{product}', [ProductController::class, 'destroy_empleado'])->name('empleado.products.destroy');
            });

            // Rutas de ventas para empleados
            Route::prefix('ventas')->group(function () {
                Route::get('/', [VentasController::class, 'ventas_empleado'])->name('ventas-empleado');
                Route::post('/store', [VentasController::class, 'crear_ventas'])->name('ventas-del-empleado');
                Route::get('/listado', [VentasController::class, 'listaventas_empleado'])->name('listado-ventas');
                Route::get('/{id}', [VentasController::class, 'ventas_show'])->name('factura.ventas');
            });

            // Rutas de auditoría para empleados
            Route::get('/Auditorio', [AuditController::class, 'pagina'])->name('historial-movimientos');

        });
    });

    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            // Rutas de auditoría para administradores
            Route::get('/Auditorio', [AuditController::class, 'pagina_admin'])->name('historial-movimientos-admin');
        });
    });
});

// Rutas de recursos (accesibles para todos los usuarios autenticados)
Route::resource('products', ProductController::class);
Route::resource('ventas', VentasController::class); // Solo las rutas necesarias para 'ventas'
Route::resource('suppliers', SupplierController::class);
Route::resource('categorys', CategoryController::class);
