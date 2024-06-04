<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     *
     * @return BelongsTo
     */
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    /**
     * Get the state associated with the task.
     *
     * @return BelongsTo
     */
    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }

    /**
     * Get the priority associated with the task.
     *
     * @return BelongsTo
     */
    public function prioridad(): BelongsTo
    {
        return $this->belongsTo(Prioridad::class, 'idPrioridad');
    }
}


// Jhonathan Uni sisa 55222510