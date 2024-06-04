<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\TareaController;

Route::apiResource('empleados', EmpleadoController::class);
Route::apiResource('estados', EstadoController::class);
Route::apiResource('prioridades', PrioridadController::class);
Route::apiResource('tareas', TareaController::class);

Route::post('tareas/{tarea}/cambiar-estado', [TareaController::class, 'cambiarEstado']);
Route::post('tareas/{tarea}/reasignar', [TareaController::class, 'reasignar']);
Route::post('tareas/{tarea}/agregar-observacion', [TareaController::class, 'agregarObservacion']);
