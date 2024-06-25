<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pagina(Request $request)
    {
        // Obtener el rol del usuario autenticado
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        // Filtros
        $dateFilter = $request->input('date_filter');
        $roleFilter = $request->input('role_filter');

        // Query base de auditorías
        $auditsQuery = Audit::query();

        // Aplicar filtro por fecha si está presente
        if ($dateFilter) {
            $auditsQuery->whereDate('created_at', Carbon::parse($dateFilter));
        }

        // Aplicar filtro por rol si está presente y el usuario no es admin
        if (!$isAdmin && $roleFilter) {
            if ($roleFilter === 'admin') {
                // Filtro para mostrar solo auditorías de administradores
                $auditsQuery->whereHas('user', function ($query) {
                    $query->where('role_id', 1); // ID del rol de administrador
                });
            } elseif ($roleFilter === 'empleado') {
                // Filtro para mostrar solo auditorías de empleados
                $auditsQuery->whereHas('user', function ($query) {
                    $query->where('role_id', '<>', 1); // No es el ID del rol de administrador
                });
            }
        }

        // Obtener los registros de auditoría según los filtros
        $audits = $auditsQuery->latest()->get();

        // Pasar variables a la vista
        return view('empleado.movimientos.index', compact('audits', 'isAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

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
