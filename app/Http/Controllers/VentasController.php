<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; // Modelo para las órdenes de venta
use App\Models\OrderDetail;

class VentasController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $selectedCategory = $request->input('category');

        if ($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }

        return view('ventas.venta', compact('products', 'categories', 'selectedCategory'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('ventas.registro', compact('product'));
    }

    public function store(Request $request)
    {
        // Validar los datos enviados
        $validatedData = $request->validate([
            'cedula' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        // Buscar el producto por su nombre
        $product = Product::where('name', $request->input('nombre'))->firstOrFail();

        // Validar que la cantidad no exceda el stock disponible
        if ($request->input('cantidad') > $product->quantity) {
            return redirect()->back()->withErrors(['cantidad' => 'La cantidad a vender excede el stock disponible.']);
        }

        // Calcular el total de la orden
        $total = $validatedData['cantidad'] * $product->price;

        // Crear una nueva orden
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

        // Actualizar la cantidad de productos disponibles
        $product->quantity -= $validatedData['cantidad'];
        $product->save();

        return redirect()->route('ventas.index')->with('success', 'Producto vendido exitosamente!');
    }

    public function listaventas(Request $request){

        $categories = Category::all();
        $orders = Order::all();

        $selectedCategory = $request->input('category');

        if ($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }
        return view('ventas.listado' , compact('products', 'categories', 'selectedCategory','orders'));

    }

    public function show($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);

        return view('ventas.factura', compact('orderDetail'));
    }

    public function factura($id)
    {
        
        $order = Order::findOrFail($id);

        
        return view('ventas.factura', compact('order'));
    }
}
