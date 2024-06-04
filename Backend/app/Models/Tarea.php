<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }

    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'idPrioridad');
    }
}
