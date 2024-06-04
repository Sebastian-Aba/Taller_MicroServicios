<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'idEmpleado');
    }
}
