<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; // Modelo para las órdenes de venta
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;


class VentasController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $selectedCategory = $request->input('category');
        $searchTerm = $request->input('search');

        $productsQuery = Product::query();

        if ($selectedCategory) {
            $productsQuery->where('category_id', $selectedCategory);
        }

        if ($searchTerm) {
            $productsQuery->where('name', 'like', '%' . $searchTerm . '%');
        }

        $products = $productsQuery->paginate(5);

        return view('ventas.venta', compact('products', 'categories', 'selectedCategory', 'searchTerm'));
    }


    public function ventas_empleado(Request $request)
    {
        $categories = Category::all();

        $selectedCategory = $request->input('category');
        $searchTerm = $request->input('search');

        $productsQuery = Product::query();

        if ($selectedCategory) {
            $productsQuery->where('category_id', $selectedCategory);
        }

        if ($searchTerm) {
            $productsQuery->where('name', 'like', '%' . $searchTerm . '%');
        }

        $products = $productsQuery->paginate(5);

        return view('empleado.ventas.venta', compact('products', 'categories', 'selectedCategory', 'searchTerm'));
    }



    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('ventas.registro', compact('product'));
    }


    public function ventas($id)
    {
        $product = Product::findOrFail($id);
        return view('empleado.ventas.registro', compact('product'));
    }

    public function store(Request $request)
    {
        // Validación de datos del formulario
        $validatedData = $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        // Buscar el producto por nombre
        $product = Product::where('name', $request->input('nombre'))->firstOrFail();

        // Validar la cantidad disponible
        if ($request->input('cantidad') > $product->quantity) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad a vender excede el stock disponible.']);
        }

        // Calcular el total de la venta
        $total = $validatedData['cantidad'] * $product->price;

        // Crear la orden de venta
        $order = Order::create([
            'user_id' => auth()->id(),
            'nombre' => $validatedData['nombre'],
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
            'ubicacion' => $validatedData['ubicacion'],
        ]);

        // Crear el detalle de la orden
        OrderDetail::create([
            'order_id' => $order->id,
            'cedula' => $validatedData['cedula'],
            'product_id' => $product->id,
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
        ]);

        // Actualizar la cantidad de producto en stock
        $product->quantity -= $validatedData['cantidad'];
        $product->save();

        // Llamar al método para registrar la auditoría
        $this->logAudit('venta creada', $product);

        // Notificación flash de éxito
        Session::flash('success', 'Producto vendido exitosamente!');

        // Redireccionar a la página de ventas
        return redirect()->route('ventas.index');
    }


    public function crear_ventas(Request $request)
    {
        // Validación de datos del formulario
        $validatedData = $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        // Buscar el producto por nombre
        $product = Product::where('name', $request->input('nombre'))->firstOrFail();

        // Validar la cantidad disponible
        if ($request->input('cantidad') > $product->quantity) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad a vender excede el stock disponible.']);
        }

        // Calcular el total de la venta
        $total = $validatedData['cantidad'] * $product->price;

        // Crear la orden de venta
        $order = Order::create([
            'user_id' => auth()->id(),
            'nombre' => $validatedData['nombre'],
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
            'ubicacion' => $validatedData['ubicacion'],
        ]);

        // Crear el detalle de la orden
        OrderDetail::create([
            'order_id' => $order->id,
            'cedula' => $validatedData['cedula'],
            'product_id' => $product->id,
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
        ]);

        // Actualizar la cantidad de producto en stock
        $product->quantity -= $validatedData['cantidad'];
        $product->save();

        // Llamar al método para registrar la auditoría
        $this->logAudit('venta creada por empleado', $product);

        // Notificación flash de éxito
        Session::flash('success', 'Producto vendido exitosamente!');

        // Redireccionar a la página de ventas
        return redirect()->route('ventas-empleado');
    }

    public function listaventas(Request $request)
    {

        $categories = Category::all();
        $selectedCategory = $request->input('category');
        $searchTerm = $request->input('search');

        $ordersQuery = Order::query()->with('orderDetails.product');

        if ($selectedCategory) {
            $ordersQuery->whereHas('orderDetails.product', function ($query) use ($selectedCategory) {
                $query->where('category_id', $selectedCategory);
            });
        }

        if ($searchTerm) {
            $ordersQuery->where('nombre', 'like', '%' . $searchTerm . '%');
        }

        $orders = $ordersQuery->paginate(5); // Ajusta el número de elementos por página según tu preferencia

        return view('ventas.listado', compact('orders', 'categories', 'selectedCategory', 'searchTerm'));
    }

    public function listaventas_empleado(Request $request)
    {

        $categories = Category::all();
        $selectedCategory = $request->input('category');
        $searchTerm = $request->input('search');

        $ordersQuery = Order::query()->with('orderDetails.product');

        if ($selectedCategory) {
            $ordersQuery->whereHas('orderDetails.product', function ($query) use ($selectedCategory) {
                $query->where('category_id', $selectedCategory);
            });
        }

        if ($searchTerm) {
            $ordersQuery->where('nombre', 'like', '%' . $searchTerm . '%');
        }

        $orders = $ordersQuery->paginate(5); // Ajusta el número de elementos por página según tu preferencia

        return view('empleado.ventas.listado', compact('orders', 'categories', 'selectedCategory', 'searchTerm'));
    }



    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view('ventas.factura', compact('orderDetail'));
    }


    public function ventas_show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        return view('empleado.ventas.factura', compact('orderDetail'));
    }

    public function factura($id)
    {
        $order = Order::findOrFail($id);
        return view('ventas.factura', compact('order'));
    }

    public function descargarFactura($id)
    {
        // Obtener el detalle de la orden
        $orderDetail = OrderDetail::findOrFail($id);

        // Generar el HTML de la factura
        $pdf = new Dompdf();
        $pdf->setOptions(new Options([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]));
        $pdf->loadHtml(view('ventas.facturapdf', compact('orderDetail'))->render());

        // Renderizar y generar el PDF
        $pdf->render();

        // Descargar el PDF con el nombre 'factura-{id}.pdf'
        return $pdf->stream("factura-{$id}.pdf");
    }

    private function logAudit($accion, $product)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        if ($user) {
            // Obtener el rol del usuario autenticado
            $rol = $user->isAdmin() ? 'admin' : 'empleado';

            // Crear el registro de auditoría
            \App\Models\Audit::create([
                'user_id' => $user->id,
                'action' => $accion,
                'entity_type' => 'App\Models\Product',
                'entity_id' => $product->id,
                'details' => 'Acción ' . $accion . ' de producto: ' . $product->name . ' por ' . $rol,
            ]);
        } else {
            // Manejo de caso donde no hay usuario autenticado (esto depende de la lógica de tu aplicación)
            // Puedes lanzar una excepción, registrar en un log, o manejar de otra manera según tus requerimientos
            // Por ejemplo:
            throw new \Exception('No se encontró un usuario autenticado para registrar la auditoría.');
        }
    }
}
