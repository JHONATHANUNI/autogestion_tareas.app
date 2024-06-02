<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['message' => 'Conexión a la base de datos exitosa']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);
        }
    }
}
