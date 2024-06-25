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
use App\Mail\FacturaMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


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
        $validatedData = $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $product = Product::where('name', $validatedData['nombre'])->first();

        if (!$product) {
            return redirect()->back()->withErrors(['nombre' => 'El producto no existe.']);
        }

        if ($validatedData['cantidad'] > $product->quantity) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad a vender excede el stock disponible.']);
        }

        $total = $validatedData['cantidad'] * $product->price;

        $order = Order::create([
            'user_id' => auth()->id(),
            'nombre' => $validatedData['nombre'],
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
            'ubicacion' => $validatedData['ubicacion'],
        ]);

        $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'cedula' => $validatedData['cedula'],
            'product_id' => $product->id,
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
        ]);

        $product->quantity -= $validatedData['cantidad'];
        $product->save();

        $this->logAudit('venta creada', $product);

        // Verificar si se proporcionó un correo electrónico y si está lleno antes de intentar enviar el correo
        $email = $request->input('email');
        if (!empty($email)) {
            try {
                Mail::to($email)->send(new FacturaMail($orderDetail));
                Session::flash('success', 'Producto vendido exitosamente y se ha enviado la factura por correo electrónico.');
            } catch (\Exception $e) {
                Log::error('Error al enviar el correo: ' . $e->getMessage());
                Session::flash('success', 'Producto vendido exitosamente, pero hubo un problema al enviar el correo.');
            }
        } else {
            Session::flash('success', 'Producto vendido exitosamente!');
        }

        return redirect()->route('ventas.index');
    }

    public function crear_ventas(Request $request)
    {
        $validatedData = $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $product = Product::where('name', $validatedData['nombre'])->firstOrFail();

        if ($validatedData['cantidad'] > $product->quantity) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad a vender excede el stock disponible.']);
        }

        $total = $validatedData['cantidad'] * $product->price;

        $order = Order::create([
            'user_id' => auth()->id(),
            'nombre' => $validatedData['nombre'],
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
            'ubicacion' => $validatedData['ubicacion'] ?? null,
        ]);

        $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'cedula' => $validatedData['cedula'],
            'product_id' => $product->id,
            'cantidad' => $validatedData['cantidad'],
            'total' => $total,
        ]);

        $product->quantity -= $validatedData['cantidad'];
        $product->save();

        $this->logAudit('venta creada por empleado', $product);

        $email = $request->input('email');
        if (!empty($email)) {
            try {
                Mail::to($email)->send(new FacturaMail($orderDetail));
                Session::flash('success', 'Producto vendido exitosamente y se ha enviado la factura por correo electrónico.');
            } catch (\Exception $e) {
                Log::error('Error al enviar el correo: ' . $e->getMessage());
                Log::error('Traza del error: ' . $e->getTraceAsString());
                Session::flash('warning', 'Producto vendido exitosamente, pero hubo un problema al enviar el correo. Error: ' . $e->getMessage());
            }
        } else {
            Session::flash('success', 'Producto vendido exitosamente!');
        }

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
