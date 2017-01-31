<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $timestamps = false;
    protected $table = 'Empleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechaInicio', 
        'fechaFin', 
        'Persona_id',
        'Centro_Distribucion_id',
        'Tipo_Empleado_id',
        'Jefe_id'
    ];
}
