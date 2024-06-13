<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\ProductRequest;
use App\Models\Role;

class VentasController extends Controller
{
   
    public function index(Request $request)
    {
        $categories = Category::all();
    
        // Obtener la categoría seleccionada del request
        $selectedCategory = $request->input('category');
    
        // Filtrar productos por la categoría seleccionada si existe
        if ($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }
    
        return view('ventas.venta', compact('products', 'categories', 'selectedCategory'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function edit(Product $product)
    {
        return view('ventas.registro', compact('product'));
    }



    
    public function store(ProductRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('ventas.venta')->with('success', 'Venta registrado successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
