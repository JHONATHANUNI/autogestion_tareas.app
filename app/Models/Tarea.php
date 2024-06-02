<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tareas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'fechaEstimadaFinalizacion',
        'fechaFinalizacion',
        'creadorTarea',
        'idEmpleado',
        'idEstado',
        'idPrioridad',
        'observaciones'
    ];

    /**
     * Get the employee that owns the task.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    /**
     * Get the state associated with the task.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }

    /**
     * Get the priority associated with the task.
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'idPrioridad');
    }
}
