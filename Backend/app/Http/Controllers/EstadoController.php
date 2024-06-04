<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        return Estado::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:100'
        ]);

        $estado = Estado::create($validatedData);
        return response()->json($estado, 201);
    }

    public function show($id)
    {
        return Estado::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:100'
        ]);

        $estado = Estado::findOrFail($id);
        $estado->update($validatedData);
        return response()->json($estado, 200);
    }

    public function destroy($id)
    {
        Estado::destroy($id);
        return response()->json(null, 204);
    }
}
