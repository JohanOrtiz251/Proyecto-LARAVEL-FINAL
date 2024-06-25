<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Audit;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(SupplierRequest $request)
    {
        // Crear el proveedor
        $supplier = Supplier::create($request->validated());

        // Registrar la acción en auditoría
        $this->logAudit('crear', $supplier);

        return redirect()->route('suppliers.index')->with('success', '¡Proveedor creado exitosamente!');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        // Actualizar el proveedor
        $supplier->update($request->validated());

        // Registrar la acción en auditoría
        $this->logAudit('actualizar', $supplier);

        return redirect()->route('suppliers.index')->with('success', '¡Proveedor actualizado exitosamente!');
    }

    public function destroy(Supplier $supplier)
    {
        // Registrar la acción en auditoría antes de eliminar el proveedor
        $this->logAudit('eliminar', $supplier);

        // Eliminar el proveedor
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', '¡Proveedor eliminado exitosamente!');
    }

    /**
     * Registrar la acción en el registro de auditoría.
     *
     * @param string $accion
     * @param \App\Models\Supplier $supplier
     */
    protected function logAudit($accion, Supplier $supplier)
    {
        Audit::create([
            'user_id' => Auth::id(),
            'action' => $accion,
            'entity_type' => 'App\Models\Supplier',
            'entity_id' => $supplier->id,
            'details' => 'Acción ' . $accion . ' en proveedor: ' . $supplier->name,
        ]);
    }
}
