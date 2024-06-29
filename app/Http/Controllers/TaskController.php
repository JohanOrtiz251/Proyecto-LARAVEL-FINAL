<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $employeeId = $request->input('employee');

        $tasksQuery = Task::query();

        if ($searchTerm) {
            $tasksQuery->where('title', 'like', '%' . $searchTerm . '%');
        }

        if ($employeeId) {
            $tasksQuery->where('assigned_to', $employeeId);
        }

        $tasks = $tasksQuery->paginate(10);

        $employees = User::where('role_id', 2)->get(); // Assuming '2' is the role ID for employees

        return view('tareas.tareas', compact('tasks', 'searchTerm', 'employees', 'employeeId'));
    }


    



    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtén la lista de empleados (asumiendo que los empleados tienen un rol específico)
        $employees = User::where('role_id', 2)->get(); // Ajusta el campo de rol según tu esquema de base de datos

        return view('tareas.create', compact('employees'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id', // Validación para asegurarse de que el usuario exista en la tabla users
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $task = new Task();
        $task->assigned_by = auth()->user()->id; // Asignar la tarea al usuario autenticado
        $task->assigned_to = $request->assigned_to; // Asignar la tarea al empleado seleccionado
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return redirect()->route('tareas.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }


    public function show_emple(Task $tarea)
    {
        return view('empleado.asignaciones.show', compact('tarea'));
    }

   
    public function edit(Task $tarea)
    {
        $employees = User::where('role_id', 2)->get(); // Obtén la lista de empleados

        return view('tareas.edit', compact('tarea', 'employees'));
    }

    public function tareasNoRealizadas()
    {
        $tareas = Task::where('assigned_to', auth()->id())
            ->where(function ($query) {
                $query->where('completed', false)
                    ->orWhereNull('completed'); // Considera las tareas no completadas y las que no tienen estado definido
            })
            ->paginate(10);

        return view('empleado.asignaciones.sin_hacer', compact('tareas'));
    }

    public function tareasRealizadas()
    {
        $tareas = Task::where('assigned_to', auth()->id())->where('completed', true)->paginate(10);
        return view('empleado.asignaciones.realizado', compact('tareas'));
    }


    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $tarea)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada exitosamente.');
    }


    public function completar(Request $request, Task $tarea)
    {
        $request->validate([
            'completed' => 'required|boolean',
        ]);

        $tarea->completed = $request->completed;
        $tarea->save();

        return redirect()->route('empleado.tareas.no_realizadas')
            ->with('success', 'Estado de la tarea actualizado exitosamente.');
    }
    /**
     * Remove the specified task from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }
}
