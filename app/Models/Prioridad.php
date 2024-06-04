<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    protected $fillable = ['nombre'];

    /**
     * Get the tasks for the priority.
     *
     * @return HasMany
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'idPrioridad');
    }
}

