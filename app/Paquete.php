<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    public $timestamps = false;
    protected $table = 'Paquete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peso', 
        'volumen', 
        'fragilidad',
        'prioridad',
        'Vehiculo_id',
        'Centro_Distribucion_idEmisor',
        'Centro_Distribucion_idReceptor',
        'Persona_idEmisor',
        'Persona_idReceptor'
    ];
}
