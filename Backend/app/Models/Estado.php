<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'idEstado');
    }
}
