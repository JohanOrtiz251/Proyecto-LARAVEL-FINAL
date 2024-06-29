<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'assigned_by', 'assigned_to', 'completed'];

    // Relación con el modelo User para el empleado asignado
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relación con el modelo User para el creador de la tarea
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
