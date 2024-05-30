<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        try {
            $tareas = Tarea::with('empleado', 'estado', 'prioridad')->get();
            return response()->json($tareas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las tareas: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $tarea = Tarea::with('empleado', 'estado', 'prioridad')->findOrFail($id);
            return response()->json($tarea);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'título' => 'required|string|max:120',
                'descripción' => 'required|string',
                'fechaEstimadaFinalizacion' => 'required|date',
                'creadorTarea' => 'required|string|max:250',
                'IdEmpleado' => 'required|exists:empleados,id',
                'IdEstado' => 'required|exists:estados,id',
                'IdPrioridad' => 'required|exists:prioridades,id',
                'observaciones' => 'nullable|string'
            ]);

            $tarea = Tarea::create($validated);
            return response()->json(['message' => 'Tarea creada con éxito', 'data' => $tarea], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'título' => 'sometimes|string|max:120',
                'descripción' => 'sometimes|string',
                'fechaEstimadaFinalizacion' => 'sometimes|date',
                'creadorTarea' => 'sometimes|string|max:250',
                'IdEmpleado' => 'sometimes|exists:empleados,id',
                'IdEstado' => 'sometimes|exists:estados,id',
                'IdPrioridad' => 'sometimes|exists:prioridades,id',
                'observaciones' => 'nullable|string'
            ]);

            $tarea = Tarea::findOrFail($id);
            $tarea->update($validated);
            return response()->json(['message' => 'Tarea actualizada con éxito', 'data' => $tarea]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            $tarea->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la tarea: ' . $e->getMessage()], 500);
        }
    }
}
