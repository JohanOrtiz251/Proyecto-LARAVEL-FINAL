<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\Auth\LogeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentasController;
use App\Models\Audit;

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
    Route::prefix('ventas')->group(function () {
        Route::get('/listaventas', [VentasController::class, 'listaventas'])->name('ventas.listaventas');
        Route::get('/{id}', [VentasController::class, 'show'])->name('ventas.show');
        Route::get('/{id}/descargar-factura', [VentasController::class, 'descargarFactura'])->name('ventas.descargar-factura');
    });

    // Rutas para empleados
    Route::prefix('empleado')->group(function () {
        Route::get('/dashboard', function () {
            return view('empleado.dashboard_empleado');
        })->name('empleado');


        //rutas de productos 
        Route::get('/productos', [ProductController::class, 'index_empleados'])->name('empleado-productos');
        Route::get('empleado/products/{product}', [ProductController::class, 'show_empleado'])->name('show_empleado');
        Route::get('/products/crear', [ProductController::class, 'create_empleado'])->name('crear_producto');
        Route::get('products/create', [ProductController::class, 'create_empleado'])->name('empleado.products.create');
        Route::post('/products', [ProductController::class, 'store_empleado'])->name('productos.store');
        Route::get('products/{product}/editar', [ProductController::class, 'edit_empleado'])->name('empleado.products.edit');
        Route::put('products/{product}', [ProductController::class, 'update_empleado'])->name('empleado.products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy_empleado'])->name('empleado.products.destroy');


        //rutas de ventas

        Route::get('/ventas', [VentasController::class, 'ventas_empleado'])->name('ventas-empleado');
        Route::get('empleado/products/{product}/editar', [VentasController::class, 'ventas'])->name('empleado.ventas');
        Route::get('/ventas/listado', [VentasController::class, 'listaventas_empleado'])->name('listado-ventas');
        Route::post('/ventas/store', [VentasController::class, 'crear_ventas'])->name('ventas-del-empleado');
        Route::get('ventas/{id}', [VentasController::class, 'ventas_show'])->name('factura.ventas');

        //movimientos 

        Route::get('/Auditorio', [AuditController::class, 'pagina'])->name('historial-movimientos');

        Route::get('admin/Auditorio', [AuditController::class, 'pagina_admin'])->name('historial-movimientos-admin');





    });

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
