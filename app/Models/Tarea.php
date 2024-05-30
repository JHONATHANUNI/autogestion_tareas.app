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
        'título',
        'descripción',
        'fechaEstimadaFinalizacion',
        'fechaFinalizacion',
        'creadorTarea',
        'IdEmpleado',
        'IdEstado',
        'IdPrioridad',
        'observaciones'
    ];

    /**
     * Get the employee that owns the task.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'IdEmpleado');
    }

    /**
     * Get the state associated with the task.
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'IdEstado');
    }

    /**
     * Get the priority associated with the task.
     */
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'IdPrioridad');
    }
}
