<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prioridades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    /**
     * Get the tasks for the priority.
     */
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'idPrioridad');
    }
}
