<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\Auth\LogeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VentasController;
use App\Models\Audit;

// Ruta principal
Route::get('/', function () {
    return view('auth/login');
});

// Rutas de autenticación y registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LogeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LogeController::class, 'login'])->name('login.post');
Route::post('/logout', [LogeController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación y verificación (Sanctum)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Dashboard principal después de iniciar sesión
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->hasRole('employee')) {
            return redirect()->route('empleado.inicio');
        }
        return view('dashboard');
    })->name('dashboard');

    // Rutas específicas para VentasController (comunes para ambos roles)
    Route::prefix('ventas')->group(function () {
        Route::get('/listaventas', [VentasController::class, 'listaventas'])->name('ventas.listaventas');
        Route::get('/{id}', [VentasController::class, 'show'])->name('ventas.show');
        Route::get('/{id}/descargar-factura', [VentasController::class, 'descargarFactura'])->name('ventas.descargar-factura');
    });

    // Rutas para empleados
    Route::middleware('role:employee')->group(function () {
        // Ruta adicional para el dashboard de empleados
        Route::get('/employee/inicio', function () {
            return view('empleado.inicio_empleado');
        })->name('empleado.inicio');

        Route::prefix('empleado')->group(function () {
            Route::get('/inicio', function () {
                return view('empleado.inicio_empleado');
            })->name('empleado');

            // Rutas de productos
            Route::get('/instrucciones', function () {
                return view('empleado.instrucciones_empleado');
            })->name('instrucciones');

            Route::get('/productos', [ProductController::class, 'index_empleados'])->name('empleado-productos');
            Route::get('products/{product}', [ProductController::class, 'show_empleado'])->name('show_empleado');
            Route::get('/create', [ProductController::class, 'create_empleado'])->name('empleado.products.create');
            Route::post('/products', [ProductController::class, 'store_empleado'])->name('productos.store');
            Route::get('products/editar/{product}', [ProductController::class, 'edit_empleado'])->name('empleado.products.edit');
            Route::put('products/{product}', [ProductController::class, 'update_empleado'])->name('empleado.products.update');
            Route::delete('products/{product}', [ProductController::class, 'destroy_empleado'])->name('empleado.products.destroy');

            // Rutas de ventas
            Route::get('/ventas', [VentasController::class, 'ventas_empleado'])->name('ventas-empleado');
            Route::get('products/{product}/editar', [VentasController::class, 'ventas'])->name('empleado.ventas');
            Route::get('/ventas/listado', [VentasController::class, 'listaventas_empleado'])->name('listado-ventas');
            Route::post('/ventas/store', [VentasController::class, 'crear_ventas'])->name('ventas-del-empleado');
            Route::get('ventas/{id}', [VentasController::class, 'ventas_show'])->name('factura.ventas');

            // Movimientos
            Route::get('/Auditorio', [AuditController::class, 'pagina'])->name('historial-movimientos');



           


            Route::patch('/tareas/{tarea}/completar', [TaskController::class, 'completar'])->name('asignacion.completar');

            Route::get('/tareas/{tarea}', [TaskController::class, 'show_emple'])->name('empleado.tareas.show');

            Route::get('/asignaciones', [TaskController::class, 'tareasNoRealizadas'])->name('empleado.tareas.no_realizadas');


            Route::get('/faltantes', [TaskController::class, 'tareasRealizadas'])->name('empleado.tareas.realizadas');
        });
    });

    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/inicio', function () {
            return view('inicio');
        })->name('admin.dashboard');

        Route::get('admin/Auditorio', [AuditController::class, 'pagina_admin'])->name('historial-movimientos-admin');

        Route::prefix('admin')->group(function () {
            Route::resource('tareas', TaskController::class)->parameters(['tareas' => 'tarea']);


            // Rutas de recursos
            Route::resource('products', ProductController::class)->parameters(['products' => 'product']);
            Route::resource('ventas', VentasController::class)->parameters(['ventas' => 'venta']);
            Route::resource('suppliers', SupplierController::class)->parameters(['suppliers' => 'supplier']);
            Route::resource('categorys', CategoryController::class)->parameters(['categorys' => 'category']);
        });
    });
});
