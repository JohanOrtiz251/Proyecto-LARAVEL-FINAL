<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
    }

    public function create()
    {
        return view('categorys.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('categorys.index')->with('success', 'Categoría creada exitosamente!');
    }

    public function show(Category $category)
    {
        return view('categorys.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categorys.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categorys.index')->with('success', 'Categoría actualizada exitosamente!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'Categoría eliminada exitosamente!');
    }
}
