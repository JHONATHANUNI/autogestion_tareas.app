<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory as ValidatorFactory;

class ValidateTarea
{
    protected $validator;

    public function __construct(ValidatorFactory $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'titulo' => 'required|string|max:120',
            'descripcion' => 'required|string',
            'fechaEstimadaFinalizacion' => 'required|date',
            'creadorTarea' => 'required|string|max:250',
            'idEmpleado' => 'required|exists:empleados,id',
            'idEstado' => 'required|exists:estados,id',
            'idPrioridad' => 'required|exists:prioridades,id',
            'observaciones' => 'nullable|string'
        ];

        $validator = $this->validator->make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $next($request);
    }
}
