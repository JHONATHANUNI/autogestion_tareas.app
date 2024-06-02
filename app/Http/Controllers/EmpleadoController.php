<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class EmpleadoController extends Controller
{
    public function index()
    {
        try {
            $empleados = Empleado::all();
            return response()->json($empleados);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los empleados: ' . $e->getMessage()], 500);
        }
    }

    // Aquí puedes agregar más métodos para manejar otras operaciones CRUD si es necesario
}
