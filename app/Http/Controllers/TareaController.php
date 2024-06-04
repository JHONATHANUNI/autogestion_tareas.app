<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


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


    public function index(Request $request)
    {
        $search_title = $request->query('search_title');
        $filter_start_date = $request->query('startDate');
        $filter_end_date = $request->query('endDate');
        $filter_priority = $request->query('idPrioridad');
        $filter_status = $request->query('idEstado');
        $filter_employee = $request->query('idEmpleado');
        $order_by = $request->query('order_by');

        $tasks = Tarea::query();

        if ($search_title) {
            $tasks->where('titulo', 'like', '%' . $search_title . '%');
        }

        if ($filter_start_date) {
            $tasks->where('fechaEstimadaFinalizacion', '>=', $filter_start_date);
        }

        if ($filter_end_date) {
            $tasks->where('fechaEstimadaFinalizacion', '<=', $filter_end_date);
        }

        if ($filter_priority) {
            $tasks->where('idPrioridad', $filter_priority);
        }

        if ($filter_status) {
            $tasks->where('idEstado', $filter_status);
        }

        if ($filter_employee) {
            $tasks->where('idEmpleado', $filter_employee);
        }

        if ($order_by === 'priority') {
            $tasks->orderBy('idPrioridad', 'asc');
        } elseif ($order_by === 'estimated-end-date') {
            $tasks->orderBy('fechaEstimadaFinalizacion', 'asc');
        }

        $tasks = $tasks->get();

        return $tasks;
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
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Tarea no encontrada'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error en la base de datos: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la tarea: ' . $e->getMessage()], 500);
        }
    }
    
    
    
    
    // función para obtener las tareas agrupadas por estado:

    public function getTasksByStatus()
    {
        $tasks_by_status = [];

        $states = Estado::all();

        foreach ($states as $state) {
            $tasks_by_status[$state->nombre] = Tarea::where('idEstado', $state->id)->get();
        }

        return response()->json(['tasks_by_status' => $tasks_by_status]);
    }
}

// Jhonathan Uni sisa 55222510