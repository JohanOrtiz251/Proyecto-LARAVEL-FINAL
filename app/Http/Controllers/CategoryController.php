<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Audit;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // Crear la categoría
        $category = Category::create($request->validated());

        // Registrar la acción en auditoría
        $this->logAudit('crear', $category);

        return redirect()->route('categorys.index')->with('success', 'Categoría creada exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categorys.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categorys.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // Actualizar la categoría
        $category->update($request->validated());

        // Registrar la acción en auditoría
        $this->logAudit('actualizar', $category);

        return redirect()->route('categorys.index')->with('success', 'Categoría actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Registrar la acción en auditoría antes de eliminar la categoría
        $this->logAudit('eliminar', $category);

        // Eliminar la categoría
        $category->delete();

        return redirect()->route('categorys.index')->with('success', 'Categoría eliminada exitosamente!');
    }

    /**
     * Registrar la acción en el registro de auditoría.
     *
     * @param string $accion
     * @param \App\Models\Category $category
     */
    protected function logAudit($accion, Category $category)
    {
        Audit::create([
            'user_id' => Auth::id(),
            'action' => $accion,
            'entity_type' => 'App\Models\Category',
            'entity_id' => $category->id,
            'details' => 'Acción ' . $accion . ' de categoría: ' . $category->name,
        ]);
    }
}

