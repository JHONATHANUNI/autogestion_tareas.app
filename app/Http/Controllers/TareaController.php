<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Agrega esta línea para importar Validator

class TareaController extends Controller
{

    public function createTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required|string|max:255',
            'idEmpleado' => 'required|integer|exists:empleados,id',
            'idEstado' => 'required|integer|exists:estados,id',
            'idPrioridad' => 'required|integer|exists:prioridades,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $tarea = new Tarea;
        $tarea->titulo = $request->input('titulo');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->fechaEstimadaFinalizacion = $request->input('fechaEstimadaFinalizacion');
        $tarea->creadorTarea = $request->input('creadorTarea');
        $tarea->idEmpleado = $request->input('idEmpleado');
        $tarea->idEstado = $request->input('idEstado');
        $tarea->idPrioridad = $request->input('idPrioridad');
        $tarea->save();
    
        return response()->json(['message' => 'Tarea creada exitosamente'], 201);
    }
    
    
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fechaEstimadaFinalizacion' => 'required|date',
                'creadorTarea' => 'required|string|max:255',
                'idEmpleado' => 'required|integer|exists:empleados,id',
                'idEstado' => 'required|integer|exists:estados,id',
                'idPrioridad' => 'required|integer|exists:prioridades,id',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $tarea = Tarea::create($request->all());
            return response()->json(['data' => $tarea], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la tarea: ' . $e->getMessage()], 500);
        }
    }
    
    
    public function index()
    {
        try {
            $tareas = Tarea::with('empleado', 'estado', 'prioridad')->get();
            return response()->json(['data' => $tareas]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las tareas: ' . $e->getMessage()], 500);
        }
    }
    

    public function show($id)
    {
        try {
            $tarea = Tarea::with('empleado', 'estado', 'prioridad')->findOrFail($id);
            $data = ['data' => $tarea];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'sometimes|string|max:120',
                'descripcion' => 'sometimes|string',
                'fechaEstimadaFinalizacion' => 'sometimes|date',
                'creadorTarea' => 'sometimes|string|max:250',
                'idEmpleado' => 'sometimes|exists:empleados,id',
                'idEstado' => 'sometimes|exists:estados,id',
                'idPrioridad' => 'sometimes|exists:prioridades,id',
                'observaciones' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $tarea = Tarea::findOrFail($id);
            $tarea->update($request->all());
            $data = ['data' => $tarea];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la tarea: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            $tarea->delete();
            return response()->json(['message' => 'Tarea eliminada con éxito'], 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la tarea: ' . $e->getMessage()], 500);
        }
    }
}
