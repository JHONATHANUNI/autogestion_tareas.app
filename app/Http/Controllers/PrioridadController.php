<?php

namespace App\Http\Controllers;

use App\Models\Prioridad;
use Illuminate\Http\Request;

class PrioridadController extends Controller
{
    public function index()
    {
        try {
            $prioridades = Prioridad::all();
            return response()->json($prioridades);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener las prioridades: ' . $e->getMessage()], 500);
        }
    }

    // Aquí puedes agregar más métodos para manejar otras operaciones CRUD si es necesario
}
