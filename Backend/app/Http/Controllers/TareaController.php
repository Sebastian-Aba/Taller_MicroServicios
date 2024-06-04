<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarea::query();

        if ($request->has('prioridad')) {
            $query->where('idPrioridad', $request->prioridad);
        }
        if ($request->has('fechaInicio') && $request->has('fechaFin')) {
            $query->whereBetween('fechaEstimadaFinalizacion', [$request->fechaInicio, $request->fechaFin]);
        }
        if ($request->has('idEmpleado')) {
            $query->where('idEmpleado', $request->idEmpleado);
        }
        if ($request->has('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }
        if ($request->has('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        $tareas = $query->orderBy('idPrioridad')->orderBy('fechaEstimadaFinalizacion')->get();
        return response()->json($tareas, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|max:120',
            'descripcion' => 'required',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required|max:250',
            'idEmpleado' => 'required|exists:empleados,id',
            'idEstado' => 'required|exists:estados,id',
            'idPrioridad' => 'required|exists:prioridades,id',
        ]);

        $tarea = Tarea::create($validatedData);
        return response()->json($tarea, 201);
    }

    public function update(Request $request, Tarea $tarea)
    {
        $validatedData = $request->validate([
            'titulo' => 'sometimes|max:120',
            'descripcion' => 'sometimes',
            'fechaEstimadaFinalizacion' => 'sometimes|date',
            'creadorTarea' => 'sometimes|max:250',
            'idEmpleado' => 'sometimes|exists:empleados,id',
            'idEstado' => 'sometimes|exists:estados,id',
            'idPrioridad' => 'sometimes|exists:prioridades,id',
            'observaciones' => 'nullable',
        ]);

        $tarea->update($validatedData);
        return response()->json($tarea, 200);
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return response()->json(null, 204);
    }

    public function cambiarEstado(Request $request, Tarea $tarea)
    {
        $request->validate(['idEstado' => 'required|exists:estados,id']);
        $tarea->update(['idEstado' => $request->idEstado]);
        return response()->json($tarea, 200);
    }

    public function reasignar(Request $request, Tarea $tarea)
    {
        $request->validate(['idEmpleado' => 'required|exists:empleados,id']);
        $tarea->update(['idEmpleado' => $request->idEmpleado]);
        return response()->json($tarea, 200);
    }

    public function agregarObservacion(Request $request, Tarea $tarea)
    {
        $request->validate(['observaciones' => 'required']);
        $tarea->update(['observaciones' => $request->observaciones]);
        return response()->json($tarea, 200);
    }

    public function getTasksByStatus()
{
    $tareas = Tarea::all()->groupBy('estados');

    return view('tareas.byStatus', compact('tareas'));
}
public function updateStatus(Request $request, $idEstado)
{
    $tarea = tarea::find($idEstado);
    if (!$tarea) {
        return response()->json(['success' => false, 'message' => 'Tarea no encontrada'], 404);
    }

    $tarea->estado = $request->input('estado');
    $tarea->save();

    return response()->json(['success' => true, 'message' => 'Estado actualizado']);
}

}
