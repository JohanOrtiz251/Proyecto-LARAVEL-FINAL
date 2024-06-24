<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductIndexRequest;

class ProductController extends Controller
{
  
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
        

    } 
    
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

    public function buscador(ProductRequest $request){

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



   

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }


    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

  

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

 

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


  
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
