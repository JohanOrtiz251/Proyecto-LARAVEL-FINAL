<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Audit;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductIndexRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //admin - pagina de productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    } 
    
    //empleado - pagina de empleados
    public function index_empleados(ProductIndexRequest $request)
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
        return view('empleado.products.index', compact('products', 'categories', 'selectedCategory', 'searchTerm'));
    }

    //admin - dirige para crear productos
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    //empleado - dirige para crear productos
    public function create_empleado()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('empleado.products.create', compact('categories', 'suppliers'));
    }

    //admin - crea productos
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        $this->logAudit('crear', $product, 'admin');
        return redirect()->route('products.index')->with('success', '¡Producto creado exitosamente!');
    }

    //empleado - Crea productos
    public function store_empleado(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        $this->logAudit('crear', $product, 'empleado');
        return redirect()->route('empleado-productos')->with('success', '¡Producto creado exitosamente!');
    }

    //admin - para dirigir la vista de productos
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    //empleado - para dirigir a la vista de productos
    public function show_empleado(Product $product)
    {
        return view('empleado.products.show', compact('product'));
    }

    //admin - dirigir vista modificar 
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    //empleado - dirigir vista modificar 
    public function edit_empleado(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('empleado.products.edit', compact('product', 'categories', 'suppliers'));
    }

    //admin - actualizar
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $this->logAudit('actualizar', $product, 'admin');
        return redirect()->route('products.index')->with('success', '¡Producto actualizado exitosamente!');
    }

    //empleado - actualizar
    public function update_empleado(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $this->logAudit('actualizar', $product, 'empleado');
        return redirect()->route('empleado-productos')->with('success', '¡Producto actualizado exitosamente!');
    }

    //admin - para eliminar 
    public function destroy(Product $product)
    {
        $this->logAudit('eliminar', $product, 'admin');
        $product->delete();
        return redirect()->route('products.index')->with('success', '¡Producto eliminado exitosamente!');
    }

    //empleado - para eliminar
    public function destroy_empleado(Product $product)
    {
        $this->logAudit('eliminar', $product, 'empleado');
        $product->delete();
        return redirect()->route('empleado-productos')->with('success', '¡Producto eliminado exitosamente!');
    }

    /**
     * Registrar la acción en el registro de auditoría.
     *
     * @param string $accion
     * @param \App\Models\Product $product
     * @param string $rol
     */
    protected function logAudit($accion, Product $product, $rol)
    {
        Audit::create([
            'user_id' => Auth::id(),
            'action' => $accion,
            'entity_type' => 'App\Models\Product',
            'entity_id' => $product->id,
            'details' => 'Acción ' . $accion . ' de producto: ' . $product->name . ' por ' . $rol,
        ]);
    }
}
