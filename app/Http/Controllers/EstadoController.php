<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        try {
            $estados = Estado::all();
            return response()->json($estados);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los estados: ' . $e->getMessage()], 500);
        }
    }

    // Aquí puedes agregar más métodos para manejar otras operaciones CRUD si es necesario
}
