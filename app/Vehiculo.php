<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    public $timestamps = false;
    protected $table = 'Vehiculo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'marca',
        'modelo',
        'color',
        'placa',
        'maxCapPaq',
        'minCapPaq',
        'anio',
        'descripcion',
        'Centro_Distribucion_id',
        'Tipo_Vehiculo_id',
        'Estado_Vehiculo_id'
    ];
}
